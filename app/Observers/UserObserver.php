<?php

namespace App\Observers;

use App\Models\User;
use App\Repositories\UserRepository;
use Laravel\Passport\ClientRepository;

class UserObserver
{
    public function created(User $user)
    {
        $client = app(ClientRepository::class)->createPasswordGrantClient($user->id, 'Onfly', env('APP_URL'),'users');
        $this->addClient($user->id, $client->id, $client->plainSecret);
    }

    private function addClient(int $idUser, string $id, string $secret)
    {
        app(UserRepository::class)->update([
            'client_id' => $id,
            'client_secret' => $secret
        ], $idUser);
    }
}