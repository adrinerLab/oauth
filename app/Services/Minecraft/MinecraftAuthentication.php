<?php


namespace App\Services\Minecraft;


interface MinecraftAuthentication
{
    public function setUserInformation() : bool;

    public function isPremiumUser() : bool;
}
