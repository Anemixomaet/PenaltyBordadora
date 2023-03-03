<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'assistens';
    protected $fillable = ['id','id_persons','asistencia'];

    public function personas() 
    {
        return $this->belongsTo(Person::class, 'id_persons');
    }

}
