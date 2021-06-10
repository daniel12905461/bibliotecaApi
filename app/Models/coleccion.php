<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coleccion extends Model
{
    use HasFactory;
    protected $table = 'coleccions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'enabled'
    ];
}
