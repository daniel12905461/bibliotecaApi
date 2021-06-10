<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'codigo',
        'enabled',
        'institucion_id'
    ];
    
    public function institucion(){
        return $this->belongsTo('App\Models\institucion');
    }
}
