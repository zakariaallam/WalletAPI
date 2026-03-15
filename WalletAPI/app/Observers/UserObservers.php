<?php

namespace App\Observers;

use App\Models\User;
use App\Models\wallet;

class UserObservers {
    public function created(User $user){
       wallet::create([
        'user_id' => $user->id,
        'solde' => 0,
        'devise' => 'USDT'
       ]);
    }
}