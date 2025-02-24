<?php

namespace App\Services;

use App\Exceptions\StatusNotFoundException;
use App\Repositories\StatusRepository;

class StatusService
{
    private $statusRepository;

    public function __construct()
    {
        $this->statusRepository = new StatusRepository();
    }

    public function edit(int $id)
    {
        $status = $this->statusRepository->findFirst('id', $id);

        if (empty($status)) {
            throw new StatusNotFoundException('Status inexistente.', 404);
        }

        return $status;
    }

    public function getAll()
    {
        $status = $this->statusRepository->allNoTrashed();

        return $status;
    }
}
