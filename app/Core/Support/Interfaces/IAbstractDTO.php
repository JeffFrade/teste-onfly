<?php

namespace App\Core\Support\Interfaces;

interface IAbstractDTO
{
    /**
     * Cast DTO attributes to array
     * @return array
     */
    public function toArray(): array;
}
