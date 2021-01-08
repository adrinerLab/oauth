<?php


namespace App\Services\Minecraft;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class XboxAuthentication implements MinecraftAuthentication {

    protected array $endpoints = [
        'msft-oauth' => 'https://login.microsoftonline.com/consumers/oauth2/v2.0/authorize',
        'msft-token' => 'https://login.microsoftonline.com/consumers/oauth2/v2.0/token',
        'xbox-token' => 'https://user.auth.xboxlive.com/user/authenticate',
        'xsts-token' => 'https://xsts.auth.xboxlive.com/xsts/authorize',
        'mcft-token' => 'https://api.minecraftservices.com/authentication/login_with_xbox',
        'mcft-user' => 'https://api.minecraftservices.com/minecraft/profile',
    ];

    protected string $microsoft_access_token;
    protected string $xbox_access_token;
    protected string $xbox_security_token;
    protected string $uhs_token;
    protected string $minecraft_access_token;

    public function getConsentScreen(): RedirectResponse
    {
        $query_string = http_build_query([
            'client_id' => env('MICROSOFT_OAUTH_ID'),
            'client_secret' => env('MICROSOFT_OAUTH_KEY'),
            'redirect_uri' => env('MICROSOFT_REDIRECT_URI'),
            'scope' => 'XboxLive.signin offline_access',
            'response_type' => 'code',
        ]);

        return redirect()->away($this->endpoints['msft-oauth'].'?'.$query_string);
    }

    public function handleConsentResult(Request $request): void
    {
        abort_if(!$request->exists('code'), 400);

        $this->getMicrosoftAccessToken($request);
        $this->getXboxLiveToken();
        $this->getXboxSecurityToken();
        $this->getMinecraftToken();
    }

    public function isPremiumUser(): bool
    {
        if (!$this->getMinecraftUserProfile()) {
            return false;
        }
        return true;
    }

    private function getMicrosoftAccessToken(Request $request): void
    {
        $response = Http::asForm()->post($this->endpoints['msft-token'], [
            'client_id' => env('MICROSOFT_OAUTH_ID'),
            'client_secret' => env('MICROSOFT_OAUTH_KEY'),
            'redirect_uri' => env('MICROSOFT_REDIRECT_URI'),
            'grant_type' => 'authorization_code',
            'code' => $request->get('code'),
        ])->json();

        $this->microsoft_access_token = $response['access_token'];
    }

    private function getXboxLiveToken(): void
    {
        $response = Http::post($this->endpoints['xbox-token'], [
            'Properties' => [
                'AuthMethod' => 'RPS',
                'SiteName' => 'user.auth.xboxlive.com',
                'RpsTicket' => 'd=' . $this->microsoft_access_token,
            ],
            'RelyingParty' => 'http://auth.xboxlive.com',
            'TokenType' => 'JWT',
        ])->json();

        $this->xbox_access_token = str_replace('#', '', $response['Token']);
        $this->uhs_token = $response['DisplayClaims']['xui'][0]['uhs'];
    }

    private function getXboxSecurityToken(): void
    {
        $response = Http::post($this->endpoints['xsts-token'], [
            'Properties' => [
                'SandboxId' => 'RETAIL',
                'UserTokens' => [$this->xbox_access_token],
            ],
            'RelyingParty' => 'rp://api.minecraftservices.com/',
            'TokenType' => 'JWT',
        ])->json();

        abort_if(Arr::exists($response, 'XErr'), 400);

        $this->xbox_security_token = $response['Token'];
    }

    private function getMinecraftToken(): void
    {
        $response = Http::post($this->endpoints['mcft-token'], [
            'identityToken' => 'XBL3.0 x=' . $this->uhs_token . ';' . $this->xbox_security_token
        ])->json();

        $this->minecraft_access_token = $response['access_token'];
    }

    private function getMinecraftUserProfile(): bool|array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->minecraft_access_token
        ])->post($this->endpoints['mcft-user']);

        if ($response->failed()) {
            return false;
        }

        return $response->json();
    }
}
