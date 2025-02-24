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

    public function edit(int $id)
    {
        return $this->model->with('status')
            ->where('id', $id)
            ->first();
    }
}