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

        if ($status->isEmpty()) {
            throw new StatusNotFoundException('Não há status cadastrados', 404);
        }

        return $status;
    }
}
