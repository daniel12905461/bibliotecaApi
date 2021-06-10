<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class libro extends Model
{
    use HasFactory;
    protected $table = 'libros';
    protected $primaryKey = 'id';
    protected $fillable = [
        'codigo',
        'titulo',
        'autor_id',
        'imagen',
        'archivo',
        'numeroEdicion',
        'lugarEdicion',
        'anioEdicion',
        'descripcion',
        'enabled',
        'estado',
        'coleccion_id',
        'categoria_id'
    ];

    public function autor(){
        return $this->belongsTo('App\Models\autor');
    }
    public function categoria(){
        return $this->belongsTo('App\Models\categoria');
    }
    public function coleccion(){
        return $this->belongsTo('App\Models\coleccion');
    }

    public function scopeActive($query)
    {
        return $query->where('enabled', 1);
    }
    public function scopeOfAutor($query, $type)
    {
        if ($type != "") {
            return $query->where('autor_id', $type);
        }
    }
    public function scopeOfCategoria($query, $type)
    {
        if ($type != "") {
            return $query->where('categoria_id', $type);
        }
    }
    public function scopeOfTitulo($query, $type)
    {
        if ($type != "") {
            return $query->where('titulo', 'like', '%'.$type.'%');
        }
    }
}
