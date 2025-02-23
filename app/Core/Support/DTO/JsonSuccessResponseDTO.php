<?php

namespace App\Core\Support\DTO;

use App\Core\Support\AbstractDTO;

class JsonSuccessResponseDTO extends AbstractDTO
{
    /**
     * @var string
     */
    private $message;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var array
     */
    private $extra;

    /**
     * @param string $message
     * @param mixed $data
     * @param array $extra
     * @codeCoverageIgnore
     */
    public function __construct(
        string $message, 
        mixed $data = [], 
        mixed $extra = []
    )
    {
        $this->message = $message;
        $this->data = $data;
        $this->extra = $extra;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'data' => $this->data,
            'extra' => $this->extra
        ];
    }
}
