<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\Status;

class StatusRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Status();
    }
}
