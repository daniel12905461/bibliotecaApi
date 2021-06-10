<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prestamoLibros extends Model
{
    use HasFactory;
    protected $table = 'prestamo_libros';
    protected $primaryKey = 'id';
    protected $fillable = [
        'libros_id',
        'prestamos_id',
        'estado',
    ];
    public $timestamps = false;

    public function prestamo(){
        return $this->belongsTo('App\prestamo');
    }

    public function libro(){
        return $this->belongsTo('App\libro');
    }
}
