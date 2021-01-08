<?php


namespace App\Services\Minecraft;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class MojangAuthentication implements MinecraftAuthentication {
    protected array $responseData;

    protected string $endpoint = 'https://authserver.mojang.com/authenticate';

    public function getConsentScreen(): RedirectResponse
    {
        // TODO: Implement redirectToConsentScreen() method.
    }

    public function handleConsentResult(Request $request): void
    {
        // TODO: Implement handleConsentResult() method.
    }

    public function setUserInformation() : bool
    {
        $response = Http::get($this->endpoint, [
            'agent' => [
                'name' => 'Minecraft',
                'version' => 13,
            ],
            'username' => $this->username,
            'password' => $this->password,
        ]);

        if ($response->failed()) {
            return false;
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
