<?php

namespace Tests\Unit\Util;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticatedUser
{
    public static function getUser()
    {
        return new User([
            'id' => 1000000,
            'name' => 'Test User',
            'email' => 'test@mail.com',
            'password' => Hash::make('123')
        ]);
    }
}
