<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class abonnement extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];

    public function client(){

        return $this->belongsTo('App\Models\Client');
    }
    
}
