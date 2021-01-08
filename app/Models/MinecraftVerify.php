<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinecraftVerify extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'minecraft_uuid', 'auth_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
