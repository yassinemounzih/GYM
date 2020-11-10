<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];

    public function abonnement(){

        return $this->hasOne('App\Models\abonnement');

    }
}
