<?php


namespace App\Services\Minecraft;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class MojangAuthentication implements MinecraftAuthentication {
    protected array $responseData;

    public bool $valid = true;

    protected string $endpoint = 'https://authserver.mojang.com/authenticate';

    public function getConsentScreen(): RedirectResponse
    {
        //
    }

    public function handleConsentResult(Request $request): void
    {
        $this->setUserInformation($request->get('username'), $request->get('password'));
    }

    private function setUserInformation($username, $password) : bool
    {
        $response = Http::post($this->endpoint, [
            'agent' => [
                'name' => 'Minecraft',
                'version' => 13,
            ],
            'username' => $username,
            'password' => $password,
        ]);

        if ($response->failed()) {
            return $this->valid = false;
        }

        $this->responseData = $response->json();
        return true;
    }

    public function isPremiumUser() : bool
    {
        if (!Arr::exists($this->responseData, 'selectedProfile')) {
            return false;
        }

        return true;
    }
}
