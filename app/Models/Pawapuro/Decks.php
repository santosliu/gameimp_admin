<?php

namespace App\Models\Pawapuro;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Decks extends Model
{    
    protected $connection = 'pawapuro_app';
    
    public function school()
    {
        return $this->BelongsTo(Schools::class);
    }
}
