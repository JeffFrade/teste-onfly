<?php

namespace App\Core\Support\DTO;

use App\Core\Support\AbstractDTO;
use Throwable;

class JsonErrorResponseDTO extends AbstractDTO
{
    /**
     * @var Throwable
     */
    private $e;

    /**
     * @var mixed
     */
    private $extra;

    /**
     * @param Throwable $e
     * @param mixed $extra
     * @codeCoverageIgnore
     */
    public function __construct(Throwable $e, mixed $extra = [])
    {
        $this->e = $e;
        $this->extra = $extra;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'error' => [
                'message' => $this->e->getMessage()  ?? 'Erro crítico, favor contatar a equipe do J3M',
                'file' => $this->e->getFile() ?? '',
                'line' => $this->e->getLine() ?? ''
            ],
            'extra' => $this->extra
        ];
    }
}
