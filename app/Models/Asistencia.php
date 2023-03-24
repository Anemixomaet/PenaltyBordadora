<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencias';
    protected $fillable = ['id','id_temporada','id_categoria','id_persona','id_inscripcion','asistencia','fecha'];

    public function personas() 
    {
        return $this->belongsTo(Inscripcion::class, 'id_inscripcion');
    }

}
