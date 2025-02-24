<?php

namespace Tests\Unit\Util;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticatedUser
{
    public static function getUser()
    {
        return app(User::class)->find(1);
    }
}
