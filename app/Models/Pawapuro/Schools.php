<?php

namespace App\Models\Pawapuro;

use Illuminate\Database\Eloquent\Model;

class Schools extends Model
{    
    protected $connection = 'pawapuro_app';

    public function deck()
    {
        return $this->hasOne(Decks::class);
    }
    
}
