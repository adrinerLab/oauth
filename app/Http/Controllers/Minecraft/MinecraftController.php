<?php

namespace App\Http\Controllers\Minecraft;

use App\Http\Controllers\Controller;

class MinecraftController extends Controller {
    public function index()
    {
        return view('minecraft.gate');
    }
}
