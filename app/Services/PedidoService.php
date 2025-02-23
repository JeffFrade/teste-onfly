<?php

namespace App\Services;

use App\Events\PedidoStatusEvent;
use App\Exceptions\InvalidDateException;
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

        $pedido = $this->pedidoRepository->create($data);

        event(new PedidoStatusEvent($pedido, $user));

        return $pedido;
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
