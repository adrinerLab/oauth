<?php

namespace App\Http\Controllers\Minecraft;

use App\Http\Controllers\Controller;
use App\Services\Minecraft\MojangAuthentication;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

        return $this->minecraftAuthentication->isPremiumUser() ? '정품입니다' : '비정품입니다';
    }
}
