<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Inscripcion;
use App\Models\Person;
use App\Models\Temporada;
use App\Models\Categoria;



class Inscripciones extends Component
{
    public $inscripciones;
    public $jugadores=[];
    public $categorias=[];
    public $temporada=[];

    public $inscripcion_id;
    public $persons_id;
    public $categoria_id;
    public $temporada_id;

   


    public $modal = false;

    public function render()
    {
        $this->inscripciones = Inscripcion::all();
        $this->jugadores = Person::all();
        $this->categorias = Categoria::all();
        $this->temporada = Temporada::all();
        return view('livewire.inscripciones');
    }

    public function crear()
    {
        $this->limpiarCampos();
      //  $this->tiposPersonas();
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
        $this->inscripcion_id = null;  
        $this-> persons_id= ''; 
        $this-> categoria_id= '';  
        $this-> temporada_id= '';  
    }
    public function editar($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $this->inscripcion_id = $inscripcion->id;
        $this->persons_id = $inscripcion->id_persons;
        $this->categoria_id = $inscripcion->id_categoria;
        $this->temporada_id =$inscripcion->id_temporada;

      //  $this->tiposPersonas();
        $this->abrirModal();
    }

    public function borrar($id)
    {
        Inscripcion::find($id)->delete();
        session()->flash('message', 'Inscripcion eliminada correctamente');
    }

    public function guardar()
    {
        $inscripcion = null;

        if(is_null($this->inscripcion_id))
        {
            Inscripcion::create(
            [
                'id_temporada'=> $this->temporada_id,
                'id_categoria'=> $this->categoria_id,
                'id_persons'=> $this->persons_id
                
            ]);    
        }
        else
        {
            $inscripcion = Inscripcion::find($this->inscripcion_id);
            $inscripcion->id_temporada = $this->temporada_id;
            $inscripcion->id_categoria = $this->categoria_id;
            $inscripcion->id_persons = $this->persons_id;
            $inscripcion->save();
        }
        
         session()->flash('message',
            $this->inscripcion_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }

    // public function tiposPersonas()
    // {
    //     $this->tiposPersonas = 'tecnico';
    // }
    
}

