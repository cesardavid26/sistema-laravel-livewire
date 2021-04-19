<div>
    <a href="#" class="font-bold text-white py-2 px-4 rounded cursor-pointer  bg-green-600 hover:bg-green-500"
    wire:click="$set('open', true)">
        <i class="fas fa-edit"></i>
    </a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name='title'>
            Editar el Post 
        </x-slot>
        <x-slot name='content'>
            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">¡Imagen Cargando!</strong>
                <span class="block sm:inline">Espere un momento mientras se procesa la imagen</span>
                
              </div>
            @if ($image)
            <img class="mb-4" src="{{$image->temporaryUrl()}}" >
                
            
            @else
            
            <img src="{{Storage::url($post->image)}}" alt="">
                
            
            @endif
            <div class="mb-4">
                <x-jet-label value="Titulo del Post" />
                    <x-jet-input wire:model="post.title" type="text" class="w-full"/>
            </div>
            <div>
                <x-jet-label value="Contenido del Post" />
                <textarea wire:model="post.content" class="border-gray-300 focus: border-indigo-300 focus: ring focus: ring-indigo-200 focus: ring-opacity-50 rounded-md shadow-sm w-full" rows="6" ></textarea>
            </div>
            <div>
                <input type="file" wire:model="image" id="{{$identificador}}">
                <x-jet-input-error for="title" />
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
