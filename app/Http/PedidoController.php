<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\PedidoService;

class PedidoController extends Controller
{
    private $pedidoService;

    public function __construct(PedidoService $pedidoService)
    {
        $this->pedidoService = $pedidoService;
    }
}
