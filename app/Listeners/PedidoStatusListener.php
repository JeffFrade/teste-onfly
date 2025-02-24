<?php

namespace App\Listeners;

use App\Events\PedidoStatusEvent;
use App\Mail\PedidoStatusMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PedidoStatusListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PedidoStatusEvent $event): void
    {
        $mailable = new PedidoStatusMail(
            $event->getPedido()
        );

        Mail::to($event->getUser()->email)->queue($mailable);

        Log::info('Pedido criado | Dados: ' . json_encode($event->getPedido()));
    }
}
