<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';
    protected $fillable = ['id','id_categoria','nombre', 'apellido','cedula','telefono','email','fechaNac','imagen','genero'];

    public function categorias() 
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
