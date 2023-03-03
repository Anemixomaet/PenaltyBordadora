<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = ['id','id_persons','descripcion','comprobante'];

    public function personas() 
    {
        return $this->belongsTo(Person::class, 'id_persons');
    }
}
