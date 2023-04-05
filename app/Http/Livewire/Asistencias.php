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
    public $categorias;
    public $temporadas=[];
    public $personas=[];
    public $personas_presentes = [];

    
    //datos de asistencia
    public $asistencia_id;
    public $asistencia;
    public $fecha;


    //Datos de persona
    public $persona_id;
    public $temporada_id;
    public $categoria_id;
    public $inscripcion_id;
    

    public $modal = false;

    public function render()
    {
        $this->asistencias = Asistencia::all(); 
        $this->temporadas = Temporada::all();
        $this->categorias = Categoria::all();                             
        $this->asistencia = now()->format('Y-m-d');
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
        $this-> persona_id= ''; 
        $this-> asistencia = '';
        $this-> fecha = '';            
    }

    public function editar($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $this->asistencia_id = $asistencia->id;
        $this->persona_id = $asistencia->id_persona;
        $this->asistencia = $asistencia->asistencia;
        $this->fecha =$asistencia->fecha;

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
            // dd($this->personas_presentes);
            foreach($this->personas_presentes as $ppre)
            {
                $inscripcion = Inscripcion::where('id_temporada', $this->temporada_id)->where('id_categoria', $this->categoria_id)->where('id_persona',$ppre) ->first();
                //dd($inscripcion);
                Asistencia::create(
                    [
                        'id_temporada'=> $this->temporada_id,
                        'id_categoria'=> $this->categoria_id,
                        'id_inscripcion'=> $inscripcion->id,
                        'id_persona'=> $ppre,
                        'asistencia' => 'Asistio',
                        'fecha' => $this->fecha,
                        
                    ]);    
            }
            
        }
        else
        {
            $asistencia = Asistencia::find($this->asistencia_id);
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

    public function cambioTemporada()
    {
        if($this->temporada_id == '' || $this->categoria_id == '')
        {
            return;
        }
        
        $inscripciones = Inscripcion::where('id_temporada', $this->temporada_id)->where('id_categoria', $this->categoria_id)->get();
        $this->personas = [];
        foreach($inscripciones as $incripcion)
        {
            $this->personas[] = Persona::find($incripcion->id_persona);
        }
        //dd($personas);
    }

    public function cambioCategoria()
    {
        if($this->temporada_id == '' || $this->categoria_id == '')
        {
            return;
        }        
        $inscripciones = Inscripcion::where('id_temporada', $this->temporada_id)->where('id_categoria', $this->categoria_id)->get();
        $this->personas = [];
        foreach($inscripciones as $incripcion)
        {
            $this->personas[] = Persona::find($incripcion->id_persona);
        }
        // dd(var_dump($this->personas)); 
    }
    
}
