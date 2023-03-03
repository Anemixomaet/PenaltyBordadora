<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;

class Categorias extends Component
{
    public $categorias;
    //public $tipoPersonas = [];
    

    public $categoria_id;
    public $nombre;
    public $detalle;
    

    public $modal = false;

    public function render()
    {
        $this->categorias = Categoria::all();
        return view('livewire.categorias');
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
        $this->categoria_id = null;
        $this->nombre = '';
        $this->detalle = '';       
    }

    public function editar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $this->categoria_id = $categoria->id;
        $this->nombre = $categoria->nombre;
        $this->detalle = $categoria->apellido;

        $this->abrirModal();
    }

    public function borrar($id)
    {
        Categoria::find($id)->delete();
        session()->flash('message', 'Categoria eliminada correctamente');
    }

    public function guardar()
    {
        $categoria = null;

        if(is_null($this->categoria_id))
        {
            Categoria::create(
            [
                'nombre' => $this->nombre,
                'detalle' => $this->detalle,
                
            ]);    
        }
        else
        {
            $categoria = Categoria::find($this->categoria_id);
            $categoria->nombre = $this->nombre;
            $categoria->detalle = $this->detalle;
            $categoria->save();
        }
        
         session()->flash('message',
            $this->categoria_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }

    // public function tiposPersonas()
    // {
    //     $this->tiposPersonas = 'tecnico';
    // }
}
