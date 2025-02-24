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

    public function index(int $idUser, ?int $idStatus = null)
    {
        $model = $this->model->where('id_user', $idUser);

        if (!is_null($idStatus)) {
            $model = $model->where('id_status', $idStatus);
        }

        return $model->paginate();
    }

    public function edit(int $id)
    {
        return $this->model->with('status')
            ->where('id', $id)
            ->first();
    }
}