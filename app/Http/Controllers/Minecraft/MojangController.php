<?php

namespace App\Http\Controllers\Minecraft;

use App\Http\Controllers\Controller;
use App\Models\MinecraftVerify;
use App\Services\Minecraft\MojangAuthentication;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MojangController extends Controller {
    protected MojangAuthentication $minecraftAuthentication;

    public function __construct()
    {
        $this->minecraftAuthentication = new MojangAuthentication();
    }

    public function showForm(): View
    {
        return view('minecraft.mojang-form');
    }

    public function handleCallback(Request $request): RedirectResponse|string
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $this->minecraftAuthentication->handleConsentResult($request);

        if (!$this->minecraftAuthentication->valid) {
            return back()->with('error', true);
        }

        $user = Auth::user();

        if (!$this->minecraftAuthentication->isPremiumUser()) {
            return view('minecraft.not-premium', compact('user'));
        }

        $verified = MinecraftVerify::create([
            'user_id' => $user->id,
            'auth_type' => 'mojang',
        ]);

        return view('minecraft.verified', compact('user', 'verified'));
    }
}
