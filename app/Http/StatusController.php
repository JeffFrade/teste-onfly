<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Exceptions\StatusNotFoundException;
use App\Services\StatusService;

class StatusController extends Controller
{
    private $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }

    public function getAll()
    {
        try {
            $status = $this->statusService->getAll();

            return $this->sendJsonSuccessResponse('', $status);
        } catch (StatusNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }
}
