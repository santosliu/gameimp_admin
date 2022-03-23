<?php

namespace App\Models\LineBot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keywords extends Model
{
    // protected $table = 'keywords';
    protected $connection = 'pawapuro_app';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
