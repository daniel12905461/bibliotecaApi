<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prestamo extends Model
{
    use HasFactory;
    protected $table = 'prestamos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombres',
        'apellidos',
        'ci',
        'curso',
        'grado',
        'estado',
        'fecha',
    ];
    public $timestamps = false;

    public function libros()
    {
        return $this->belongsToMany(libro::class, 'prestamo_libros','prestamos_id','libros_id');
    }
}
