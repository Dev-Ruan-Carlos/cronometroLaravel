<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cronometro extends Model
{
    use HasFactory;

    protected $table = 'tcronometro';
    protected $primaryKey = 'id';
    protected $connection = 'criador';
}
