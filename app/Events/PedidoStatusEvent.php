<?php

namespace App\Events;

use App\Models\Pedido;
use App\Models\User;
use App\Services\StatusService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PedidoStatusEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $pedido;
    private $user;
    private $status;

    /**
     * Create a new event instance.
     */
    public function __construct(
        Pedido $pedido,
        User $user
    )
    {
        $this->pedido = $pedido;
        $this->user = $user;
        $this->status = app(StatusService::class)->edit($pedido->id_status);
    }

    public function getPedido()
    {
        return $this->pedido;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
