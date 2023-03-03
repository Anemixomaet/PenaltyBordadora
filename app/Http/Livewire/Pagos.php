<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pago;
use App\Models\Person;

class Pagos extends Component
{
    //datos para pagos
    public $pagos;
    public $personas;

    //datos de asistencia
    public $pago_id;
    public $descripcion;
    public $comprobante;

    //Datos de persona
    public $person_id;

    public $modal = false;

    public function render()
    {
        $this->pagos = Pago::all();
        $this->personas = Person::all();
        return view('livewire.pagos');
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
        $this->pago_id = null;
        $this-> descripcion = '';  
        $this-> comprobante = ''; 
        $this-> person_id= '';    
    }

    public function editar($id)
    {
        $pago = Pago::findOrFail($id);
        $this->pago_id = $pago->id;
        $this->descripcion = $pago->descripcion;
        $this->comprobante = $pago->comprobante;
        $this->person_id =$pago->id_persons;

      //  $this->tiposPersonas();
        $this->abrirModal();
    }

    public function borrar($id)
    {
        Pago::find($id)->delete();
        session()->flash('message', 'Pago eliminado correctamente');
    }

    public function guardar()
    {
        $pago = null;

        if(is_null($this->pago_id))
        {
            Pago::create(
            [
                'descripcion' => $this->descripcion,
                'comprobante' => $this->comprobante,
                'id_persons'=> $this->person_id
                
            ]);    
        }
        else
        {
            $pago = Pago::find($this->pago_id);
            $pago->descripcion = $this->descripcion;
            $pago->comprobante = $this->comprobante;
            $pago->id_persons = $this->person_id;
            $pago->save();
        }
        
         session()->flash('message',
            $this->pago_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }

    // public function tiposPersonas()
    // {
    //     $this->tiposPersonas = 'tecnico';
    // }
    
}

