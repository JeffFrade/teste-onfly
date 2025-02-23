<?php

namespace App\Core\Support\Traits;

use App\Core\Support\DTO\JsonErrorResponseDTO;
use App\Core\Support\DTO\JsonSuccessResponseDTO;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * @codeCoverageIgnore
 */
trait JsonResponse
{
    /**
     * @param string $message
     * @param mixed $data
     * @param array $extra
     * @param int $status
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    protected function sendJsonSuccessResponse(
        string $message, 
        mixed $data = [], 
        mixed $extra = [],
        int $statusCode = 200
    )
    {
        $succesDto = new JsonSuccessResponseDTO($message, $data, $extra);

        return response()->json($succesDto->toArray(), $statusCode);
    }

    /**
     * @param Throwable $e
     * @param array $extra
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    protected function sendJsonErrorResponse(Throwable $e, array $extra = [])
    {
        $errorDto = new JsonErrorResponseDTO($e, $extra);
        $statusCode = $this->getStatusCode($e);
        $this->logError($statusCode, $e);

        return response()->json($errorDto->toArray(), $statusCode);
    }

    /**
     * @return int
     */
    private function getStatusCode(Throwable $e)
    {
        if (is_numeric($e->getCode())) {
            return $e->getCode() >= 100 ? $e->getCode() : 500;
        }

        return 500;
    }

    /**
     * @param int $statusCode
     * @param Throwable $e
     * @return void
     */
    private function logError(int $statusCode, Throwable $e)
    {
        if ($statusCode >= 500) {
            Log::error('Erro | ' . json_encode($e));
        }
    }
}
