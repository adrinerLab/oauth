<?php


namespace App\Services\Minecraft;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface MinecraftAuthentication
{
    public function redirectToConsentScreen() : RedirectResponse;

    public function handleConsentResult(Request $request) : void;

    public function isPremiumUser() : bool;
}
