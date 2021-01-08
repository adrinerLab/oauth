<?php

namespace App\Http\Controllers\Minecraft;

use App\Http\Controllers\Controller;
use App\Services\Minecraft\XboxAuthentication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MicrosoftController extends Controller {
    protected XboxAuthentication $minecraftAuthentication;

    public function __construct()
    {
        $this->minecraftAuthentication = new XboxAuthentication();
    }

    public function redirectToProvider(): RedirectResponse
    {
        return $this->minecraftAuthentication->getConsentScreen();
    }

    public function handleProviderCallback(Request $request): string
    {
        $this->minecraftAuthentication->handleConsentResult($request);

        return $this->minecraftAuthentication->isPremiumUser() ? '정품입니다' : '비정품입니다';
    }
}
