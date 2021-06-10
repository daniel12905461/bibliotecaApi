<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class institucion extends Model
{
    use HasFactory;
    protected $table = 'institucions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'codigo',
        'enabled'
    ];
}
