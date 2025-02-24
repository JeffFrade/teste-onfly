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
    private $statusService;

    public function __construct()
    {
        $this->pedidoRepository = new PedidoRepository();
        $this->statusService = new StatusService();
    }

    public function index(array $data)
    {
        $idUser = Auth::user()->id;
        $status = $data['status'] ?? null;

        $pedidos = $this->pedidoRepository->index($idUser, $status);

        if ($pedidos->isEmpty()) {
            throw new PedidoNotFoundException('Não há pedidos para o usuário ou filtros informados.', 404);
        }

        return $pedidos;
    }

    public function store(array $data)
    {
        $user = Auth::user();
        $data['id_user'] = $user->id;
        $data['id_status'] = 1;

        $this->validateStartDate($data['data_ida']);
        $this->validateEndDate($data['data_ida'], $data['data_volta']);

        $pedido = $this->pedidoRepository->create($data);

        event(new PedidoStatusEvent($pedido));

        return $pedido;
    }

    public function edit(int $id)
    {
        $pedido = $this->pedidoRepository->edit($id);

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

        if (!empty($data['id_status'] ?? '')) {
            $this->statusService->edit($data['id_status']);
        }

        $this->pedidoRepository->update($data, $id);

        if (
            !empty($data['id_status'] ?? '') && 
            ($pedido->id_status != $data['id_status'] ?? '')
        ) {
            event(new PedidoStatusEvent($pedido));
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
