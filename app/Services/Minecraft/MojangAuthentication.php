<?php


namespace App\Services\Minecraft;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class MojangAuthentication implements MinecraftAuthentication {

    protected string $username, $password;

    protected array $responseData;

    protected string $endpoint = 'https://authserver.mojang.com/authenticate';

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
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
