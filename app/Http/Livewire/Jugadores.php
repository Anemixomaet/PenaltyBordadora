<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Persona;

class Jugadores extends Component
{
    public $jugadores;
    public $categorias;
    public $edad;
    
    //datos de jugador
    public $persona_id;
    public $nombre;
    public $apellido;
    public $cedula;
    public $telefono;
    public $email;
    public $fechaNac;
    public $imagen;
    public $genero=[];


    public $modal = false;

    public function render()
    {
        $this->jugadores = Persona::all();
        return view('livewire.jugadores');
        
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
        $this->persona_id = null;
        $this-> nombre = '';
        $this-> apellido = '';
        $this-> cedula = '';
        $this-> telefono = '';
        $this-> email = '';
        $this-> fechaNac = '';
        $this-> imagen = '';
        $this-> genero ='';      
    }

    public function editar($id)
    {
        $jugador = Persona::findOrFail($id);
        $this->persona_id = $jugador->id;
        $this->nombre = $jugador->nombre;
        $this->apellido = $jugador->apellido;
        $this->cedula = $jugador->cedula;
        $this->telefono = $jugador->telefono;
        $this->email = $jugador->email;
        $this->fechaNac = $jugador->fechaNacimiento;
        $this->imagen =$jugador->imagen;
        $this->genero =$jugador->genero;

        $this->abrirModal();
    }

    public function borrar($id)
    {
        Persona::find($id)->delete();
        session()->flash('message', 'Jugador eliminado correctamente');
    }

    public function guardar()
    {
        $person = null;

        if(is_null($this->persona_id))
        {
            Persona::create(
            [
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'cedula' => $this->cedula,
                'telefono'=> $this->telefono,
                'email'=> $this->email,
                'fechaNacimiento'=>$this->fechaNac,
                'imagen'=> $this->imagen,
                'genero'=> $this->genero,
                
            ]);    
        }
        else
        {
            $person = Persona::find($this->persona_id);
            $person->nombre = $this->nombre;
            $person->apellido = $this->apellido;
            $person->cedula = $this->cedula;
            $person->email = $this->email;
            $person->fechaNacimiento = $this->fechaNac;
            $person->imagen = $this->imagen;
            $person->genero = $this->genero;
            $person->save();
        }
        
         session()->flash('message',
            $this->persona_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }

    // public function tiposPersonas()
    // {
    //     $this->tiposPersonas = 'tecnico';
    // }

    
}
