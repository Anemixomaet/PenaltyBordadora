<x-jet-dialog-modal wire:model="modal" maxWidth="2xl">
    <x-slot name="title">
        {{ __('Crear Nueva Inscripcion') }}
    </x-slot>
    <x-slot name="content">
        <form>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                
                @if(count($temporada) > 0)
                    <div class="mb-4">
                        <label class="inline-block w-32 font-bold">Temporada:</label>
                        <select name="id_temporada" wire:model="temporada_id" 
                            class="w-full leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                            <option value="">Seleccione una Temporada </option>
                            @foreach($temporada as $temporadas)
                                <option value="{{ $temporadas->id }}">{{ $temporadas->detalle }} </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if(count($categorias) > 0)
                    <div class="mb-4">
                        <label class="inline-block w-32 font-bold">Cateoria:</label>
                        <select name="id_categoria" wire:model="categoria_id" 
                            class="w-full leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                            <option value="">Seleccione una Categoria </option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre}} </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if(count($jugadores) > 0)
                    <div class="mb-4">
                        <label class="inline-block w-32 font-bold">Jugador:</label>
                        <select name="person_id" wire:model="persons_id" 
                            class="w-full leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                            <option value="">Seleccione un jugador </option>
                            @foreach($jugadores as $jugador)
                                <option value="{{ $jugador->id }}">{{ $jugador->nombre }} {{ $jugador->apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click.prevent="guardar()">
            {{ __('Guardar') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2"
                    wire:click="cerrarModal()"
                    wire:loading.attr="disabled">
            {{ __('Cancelar') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>