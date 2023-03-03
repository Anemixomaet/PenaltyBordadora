<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Asistencia;
use App\Models\Person;

class Asistencias extends Component
{

    public $asistencias;
    public $personas;

    
    //datos de asistencia
    public $asistencia_id;
    public $asistencia;

    //Datos de persona
    public $person_id;
    

    public $modal = false;

    public function render()
    {
        $this->asistencias = Asistencia::all();
        $this->personas = Person::all();
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
        $this-> asistencia = '';  
        $this-> person_id= '';    
    }

    public function editar($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $this->asistencia_id = $asistencia->id;
        $this->asistencia = $asistencia->asistencia;
        $this->person_id =$asistencia->id_persons;

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
                'asistencia' => $this->asistencia,
                'id_persons'=> $this->person_id
                
            ]);    
        }
        else
        {
            $person = Asistencia::find($this->asistencia_id);
            $person->asistencia = $this->asistencia;
            $person->id_persons = $this->person_id;
            $person->save();
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
