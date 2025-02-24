<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\User;

/**
 * @codeCoverageIgnore
 */
class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new User();
    }
}
