<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripcion';
    protected $fillable = ['id','id_persons','id_categoria', 'id_temporada'];

    public function categorias() 
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function personas() 
    {
        return $this->belongsTo(Person::class, 'id_persons');
    }
    public function temporada() 
    {
        return $this->belongsTo(Temporada::class, 'id_temporada');
    }
    
}
