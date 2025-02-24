@extends('layouts.mail')

@section('content')
    <table>
        <tr>
            <td>
                <div class="text" style="padding: 0 2.5em; text-align: center;">
                    <h2>Situação do Pedido</h2>
                    <p><strong>ID:</strong> {{ $pedido->id }}</p>
                    <p><strong>Destino: {{ $pedido->destino }}</p>
                    <p><strong>Data de Ida: {{ $pedido->data_ida }}</p>
                    <p><strong>Data de Volta: {{ $pedido->data_volta }}</p>
                    <p><strong>Status:</strong> {{ $pedido->status->name }}</p>
                </div>
            </td>
        </tr>
    </table>
@stop