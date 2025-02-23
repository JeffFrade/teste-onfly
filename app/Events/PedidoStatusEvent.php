<?php

namespace App\Events;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PedidoStatusEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $pedido;
    private $user;

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
    }

    public function getPedido()
    {
        return $this->pedido;
    }

    public function getUser()
    {
        return $this->user;
    }
}
