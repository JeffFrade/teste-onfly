<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_user',
        'destino',
        'data_ida',
        'data_volta',
        'id_status'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function status()
    {
        return $this->hasOne(Pedido::class, 'id', 'id_status');
    }
}
