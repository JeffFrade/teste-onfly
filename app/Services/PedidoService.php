<?php

namespace App\Services;

use App\Events\PedidoStatusEvent;
use App\Exceptions\InvalidDateException;
use App\Exceptions\PedidoNotFoundException;
use App\Helpers\DateHelper;
use App\Repositories\PedidoRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PedidoService
{
    private $pedidoRepository;

    public function __construct()
    {
        $this->pedidoRepository = new PedidoRepository();
    }

    public function store(array $data)
    {
        $user = Auth::user();
        $data['id_user'] = $user->id;
        $data['id_status'] = 1;

        $this->validateStartDate($data['data_ida']);
        $this->validateEndDate($data['data_ida'], $data['data_volta']);

        $pedido = $this->pedidoRepository->create($data);

        event(new PedidoStatusEvent($pedido, $user));

        return $pedido;
    }

    public function edit(int $id)
    {
        $pedido = $this->pedidoRepository->findFirst('id', $id);

        if (empty($pedido) || $pedido->id_user != Auth::user()->id) {
            throw new PedidoNotFoundException('Pedido inexistente.', 404);
        }

        return $pedido;
    }

    public function update(array $data, int $id)
    {
        $pedido = $this->edit($id);

        $this->validateStartDate($data['data_ida']);
        $this->validateEndDate($data['data_ida'], $data['data_volta']);

        $this->pedidoRepository->update($data, $id);

        if (
            !empty($data['id_status'] ?? '') && 
            ($pedido->id_status != $data['id_status'] ?? '')
        ) {
            event(new PedidoStatusEvent($pedido, Auth::user()));
        }

        return $this->edit($id);
    }

    public function delete(int $id)
    {
        $this->edit($id);
        $this->pedidoRepository->delete($id);
    }

    private function validateStartDate(string $startDate)
    {
        if (!empty($startDate)) {
            $startDate = DateHelper::parse($startDate);
            $now = Carbon::now();

            if (!DateHelper::compareDates([
                $now,
                $startDate
            ])) {
                throw new InvalidDateException('Data de ida inferior a data de hoje', 400);
            }
        }
    }

    private function validateEndDate(string $startDate, string $endDate)
    {
        if (!empty($startDate) || !empty($endDate)) {
            $startDate = DateHelper::parse($startDate);
            $endDate = DateHelper::parse($endDate);

            if (!DateHelper::compareDates([
                $startDate,
                $endDate
            ])) {
                throw new InvalidDateException('Data de volta inferior a data de ida', 400);
            }
        }
    }
}
