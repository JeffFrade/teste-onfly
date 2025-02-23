<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Exceptions\InvalidDateException;
use App\Exceptions\PedidoNotFoundException;
use App\Exceptions\StatusNotFoundException;
use App\Services\PedidoService;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    private $pedidoService;

    public function __construct(PedidoService $pedidoService)
    {
        $this->pedidoService = $pedidoService;
    }

    public function store(Request $request)
    {
        try {
            $params = $this->toValidate($request);
            $pedido = $this->pedidoService->store($params);

            return $this->sendJsonSuccessResponse('Pedido cadastrado com sucesso!', $pedido);
        } catch (
            InvalidDateException |
            StatusNotFoundException $e
        ) {
            return $this->sendJsonErrorResponse($e);
        }
    }

    public function edit(int $id)
    {
        try {
            $pedido = $this->pedidoService->edit($id);

            return $this->sendJsonSuccessResponse('Dados do pedido encontrados!', $pedido);
        } catch (PedidoNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->pedidoService->delete($id);

            return $this->sendJsonSuccessResponse('Pedido excluído com sucesso!');
        } catch (PedidoNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }

    protected function toValidate(Request $request)
    {

        $toValidateArr = [
            'destino' => 'required|max:250',
            'data_ida' => 'required|date',
            'data_volta' => 'required|date',
            'id_status' => 'nullable|numeric'
        ];

        return $this->validate($request, $toValidateArr);
    }
}
