<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Person;
use App\Models\Categoria;

class Jugadores extends Component
{
    public $jugadores;
    public $categorias;
    //public $tipoPersonas = [];
    
    //datos de jugador
    public $person_id;
    public $nombre;
    public $apellido;
    public $cedula;
    public $telefono;
    public $email;
    public $fechaNac;
    public $imagen;
    public $genero;

    //Datos de categoria
    public $categoria_id;
    
    //public $password;
    //public $titulo;

    public $modal = false;

    public function render()
    {
        $this->jugadores = Person::all();
        $this->categorias = Categoria::all();
        return view('livewire.jugadores');
        
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
        $this->person_id = null;
        $this-> nombre = '';
        $this-> apellido = '';
        $this-> cedula = '';
        $this-> telefono = '';
        $this-> email = '';
        $this-> fechaNac = '';
        $this-> imagen = '';
        $this-> genero ='';   
        $this-> categoria_id= '';    
    }

    public function editar($id)
    {
        $jugador = Person::findOrFail($id);
        $this->person_id = $jugador->id;
        $this->nombre = $jugador->nombre;
        $this->apellido = $jugador->apellido;
        $this->cedula = $jugador->cedula;
        $this->telefono = $jugador->telefono;
        $this->email = $jugador->email;
        $this->fechaNac = $jugador->fechaNac;
        $this->imagen =$jugador->imagen;
        $this->genero =$jugador->genero;
        $this->categoria_id =$jugador->id_categoria;

      //  $this->tiposPersonas();
        $this->abrirModal();
    }

    public function borrar($id)
    {
        Person::find($id)->delete();
        session()->flash('message', 'Jugador eliminado correctamente');
    }

    public function guardar()
    {
        $person = null;

        if(is_null($this->person_id))
        {
            Person::create(
            [
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'cedula' => $this->cedula,
                'telefono'=> $this->telefono,
                'email'=> $this->email,
                'fechaNac'=>$this->fechaNac,
                'imagen'=> $this->imagen,
                'genero'=> $this->genero,
                'id_categoria'=> $this->categoria_id
                
            ]);    
        }
        else
        {
            $person = Person::find($this->person_id);
            $person->nombre = $this->nombre;
            $person->apellido = $this->apellido;
            $person->cedula = $this->cedula;
            $person->email = $this->email;
            $person->fechaNac = $this->fechaNac;
            $person->imagen = $this->imagen;
            $person->genero = $this->genero;
            $person->id_categoria = $this->categoria_id;
            $person->save();
        }
        
         session()->flash('message',
            $this->person_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }

    // public function tiposPersonas()
    // {
    //     $this->tiposPersonas = 'tecnico';
    // }
    
}
