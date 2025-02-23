<?php

namespace App\Services;

use App\Repositories\PedidoRepository;

class PedidoService
{
    private $pedidoRepository;

    public function __construct()
    {
        $this->pedidoRepository = new PedidoRepository();
    }
}
