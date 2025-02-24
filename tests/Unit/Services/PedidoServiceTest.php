<?php

namespace Tests\Unit\Services;

use App\Exceptions\InvalidDateException;
use App\Exceptions\PedidoNotFoundException;
use App\Models\Pedido;
use App\Services\PedidoService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;
use Tests\Unit\Util\AuthenticatedUser;

class PedidoServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $pedidoService;

    public function setUp(): void
    {
        parent::setUp();
        $this->pedidoService = new PedidoService();
    }

    public function testIndexPedido(): void
    {
        $this->be(AuthenticatedUser::getUser());

        $pedidos = $this->pedidoService->index([
            'status' => 1
        ]);

        $this->assertInstanceOf(LengthAwarePaginator::class, $pedidos);
        $this->assertFalse($pedidos->isEmpty());
        $this->assertGreaterThanOrEqual(1, $pedidos->total());
    }

    public function testIndexWrongPedido()
    {
        $this->expectException(PedidoNotFoundException::class);
        $this->be(AuthenticatedUser::getUser());

        $this->pedidoService->index([
            'status' => 2
        ]);
    }

    public function testStorePedido()
    {
        $this->be(AuthenticatedUser::getUser());
        $pedido = $this->storePedido();

        $this->assertInstanceOf(Pedido::class, $pedido);
        $this->assertEquals(1, $pedido->id_status);
        $this->assertEquals('Porto Alegre', $pedido->destino);
    }

    public function testStorePedidoWrongDataIda()
    {
        $this->expectException(InvalidDateException::class);

        $this->be(AuthenticatedUser::getUser());
        $this->storePedido('2024-01-01');
    }

    public function testStorePedidoWrongDataVolta()
    {
        $this->expectException(InvalidDateException::class);

        $this->be(AuthenticatedUser::getUser());
        $this->storePedido('2025-12-31', '2025-12-01');
    }

    public function testEditPedido()
    {
        $this->be(AuthenticatedUser::getUser());
        $pedido = $this->storePedido();

        $pedido = $this->pedidoService->edit($pedido->id);

        $this->assertInstanceOf(Pedido::class, $pedido);
        $this->assertEquals(1, $pedido->id_status);
        $this->assertEquals('Porto Alegre', $pedido->destino);
    }

    public function testEditWrongPedido()
    {
        $this->expectException(PedidoNotFoundException::class);

        $this->pedidoService->edit(2500000);
    }

    public function testUpdatePedido()
    {
        $this->be(AuthenticatedUser::getUser());
        $pedido = $this->storePedido();

        $pedido = $this->pedidoService->update([
            'destino' => 'Blumenau',
            'id_status' => 2,
            'data_ida' => '2025-12-29',
            'data_volta' => '2025-12-31'
        ], $pedido->id);

        $this->assertInstanceOf(Pedido::class, $pedido);
        $this->assertEquals(2, $pedido->id_status);
        $this->assertEquals('Blumenau', $pedido->destino);
    }

    public function testDeletePedido()
    {
        $this->expectException(PedidoNotFoundException::class);

        $this->be(AuthenticatedUser::getUser());
        $pedido = $this->storePedido();

        $this->pedidoService->delete($pedido->id);
        $this->pedidoService->edit($pedido->id);
    }

    private function storePedido(
        string $dataIda = '2025-12-29', 
        string $dataVolta = '2025-12-31'
    )
    {
        return $this->pedidoService->store([
            'destino' => 'Porto Alegre',
            'data_ida' => $dataIda,
            'data_volta' => $dataVolta
        ]);
    }
}
