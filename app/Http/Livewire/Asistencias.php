<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Asistencia;
use App\Models\Persona;
use App\Models\Temporada;
use App\Models\Categoria;
use App\Models\Inscripcion;


class Asistencias extends Component
{

    public $asistencias;
    public $personas=[];
    public $categorias;
    public $temporadas;
    public $inscripciones=[];

    
    //datos de asistencia
    public $asistencia_id;
    public $asistencia;
    public $fecha;

    //Datos de inscripcion
    public $inscripcion_id;
    public $persona_id;

    //Datos de persona
    public $person_id;
    public $temporada_id;
    public $categoria_id;
    

    public $modal = false;

    public function render()
    {
        $this->asistencias = Asistencia::all();
        $this->inscripciones = Inscripcion::all();
        return view('livewire.asistencias');
        
    }
      
    public function crear()
    {
        $this->limpiarCampos();
      
        $this->abrirModal();        
    }

    public function abrirModal()
    {
        $this->modal = true;
    }

    public function cerrarModal(){
        $this->modal = false;
    }

    public function limpiarCampos()
    {
        $this->asistencia_id = null;
        $this-> inscripcion_id= ''; 
        $this-> persona_id= ''; 
        $this-> categoria_id= '';  
        $this-> temporada_id= '';
        $this-> asistencia = '';
        $this-> fecha = '';            
    }

    public function editar($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $this->asistencia_id = $asistencia->id;
        $this->inscripcion_id = $asistencia->id_inscripcion;
        $this->persona_id = $asistencia->id_persona;
        $this->categoria_id = $asistencia->id_categoria;
        $this->temporada_id =$asistencia->id_temporada;
        $this->asistencia = $asistencia->asistencia;
        $this->fecha =$asistencia->fecha;

      //  $this->tiposPersonas();
        $this->abrirModal();
    }

    public function borrar($id)
    {
        Asistencia::find($id)->delete();
        session()->flash('message', 'Asistencia eliminada correctamente');
    }

    public function guardar()
    {
        $asistencia = null;

        if(is_null($this->asistencia_id))
        {
            Asistencia::create(
            [
                'id_inscripcion'=> $this->inscripcion_id,
                'id_temporada'=> $this->temporada_id,
                'id_categoria'=> $this->categoria_id,
                'id_persona'=> $this->persona_id,
                'asistencia' => $this->asistencia,
                'fecha' => $this->fecha,
                
            ]);    
        }
        else
        {
            $asistencia = Asistencia::find($this->asistencia_id);
            $asistencia->id_inscripcion = $this->inscripcion_id;
            $asistencia->id_temporada = $this->temporada_id;
            $asistencia->id_categoria = $this->categoria_id;
            $asistencia->id_persona = $this->persona_id;
            $asistencia->asistencia = $this->asistencia;
            $asistencia->fecha = $this->fecha;
            $asistencia->save();
        }
        
         session()->flash('message',
            $this->asistencia_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }

    // public function tiposPersonas()
    // {
    //     $this->tiposPersonas = 'tecnico';
    // }
    
}
