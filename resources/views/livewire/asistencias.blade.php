<div>
    <x-slot name="header">
        <h1 class="text-gray-900">Asistencia</h1>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                @if(session()->has('message'))
                    <div class="bg-teal-100 rounded-b text-teal-900 px-4 py-4 shadow-md my-3" role="alert">
                        <div class="flex">
                            <div>
                                <h4>{{ session('message')}}</h4>
                            </div>
                        </div>
                    </div>
                @endif
                <x-jet-secondary-button wire:click="crear()" class="mt-7 mb-7" wire:loading.attr="disabled">
                    {{ __('Nuevo') }}
                </x-jet-secondary-button>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                @if($modal)                
                    @include('livewire.asistencia.crear')
                @endif
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-50 text-black">
                            <th class="px-4 py-2">Fecha</th>
                            <th class="px-4 py-2">Temporada</th>
                            <th class="px-4 py-2">Categoria</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($asistencias as $asistencia)        
                            <tr>
                                
                                <td class="border px-4 py-2">{{$asistencia->fecha}}</td>
                                <td class="border px-4 py-2">{{$asistencia->temporadas->nombre}}</td>
                                <td class="border px-4 py-2">{{$asistencia->categorias->nombre}}</td>
                                                           
                                <td class="border px-4 py-2 text-center">   
                                    <x-jet-button wire:click="editar({{$asistencia->id}})" class="font-bold">
                                        {{ __('Editar') }}
                                    </x-jet-button>
                                    <x-jet-danger-button wire:click="borrar({{$asistencia->id}})" class="font-bold">
                                        {{ __('Borrar') }}
                                    </x-jet-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
