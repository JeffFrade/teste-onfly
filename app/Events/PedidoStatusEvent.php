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

    /**
     * Create a new event instance.
     */
    public function __construct(
        Pedido $pedido
    )
    {
        $this->pedido = $pedido;
    }

    public function getPedido()
    {
        return $this->pedido;
    }
}
