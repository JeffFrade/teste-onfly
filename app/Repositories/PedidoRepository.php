<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\Pedido;

class PedidoRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Pedido();
    }
}