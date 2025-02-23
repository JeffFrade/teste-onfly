<?php

namespace App\Services;

use App\Repositories\StatusRepository;

class StatusService
{
    private $statusRepository;

    public function __construct()
    {
        $this->statusRepository = new StatusRepository();
    }
}
