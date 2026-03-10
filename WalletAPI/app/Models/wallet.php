<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wallet extends Model
{
    protected $fillable = ['solde','devise','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
