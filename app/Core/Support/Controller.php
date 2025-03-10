<?php

namespace App\Core\Support;

use App\Core\Support\Traits\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller
{
    use AuthorizesRequests, JsonResponse, ValidatesRequests;
}
