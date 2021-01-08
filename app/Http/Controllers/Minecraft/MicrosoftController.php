<?php

namespace App\Http\Controllers\Minecraft;

use App\Http\Controllers\Controller;
use App\Models\MinecraftVerify;
use App\Services\Minecraft\XboxAuthentication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $user = Auth::user();

        if (!$this->minecraftAuthentication->isPremiumUser()) {
            return view('minecraft.not-premium', compact('user'));
        }

        $verified = MinecraftVerify::create([
            'user_id' => $user->id,
            'uuid' => $this->minecraftAuthentication->getUserUUID(),
            'auth_type' => 'microsoft',
        ]);

        return view('minecraft.verified', compact('user', 'verified'));
    }
}
