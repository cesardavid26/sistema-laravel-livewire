<div wire:init="loadPosts">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
 
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <x-table>
          <div class="px-6 py-4 flex items-center">
           {{--<input type="text" wire:model="search">--}} 

           <div class="flex items-center">
             <span>Mostrar</span>

             <select wire:model="cant" class="mx-2 border-gray-300 focus: border-indigo-300 focus: ring focus: ring-indigo-200 focus: ring-opacity-50 rounded-md shadow-sm w-full" id="">
               <option value="10">10</option>
               <option value="25">25</option>
               <option value="50">50</option>
               <option value="100">100</option>
             </select>

             <span>entradas</span>
           </div>
           <x-jet-input class="flex-1 mx-4" placeholder="Escriba que quiere buscar" type="text" wire:model="search"/>
          @livewire('create-post')
          </div>
          @if (count($posts))
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('id')">
                        ID
                        @if ($sort == 'id')
                       
                        @if ($direction == 'asc')
                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                        @else
                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                        @endif
                        @else
                        <i class="fas fa-sort float-right"></i>
                        @endif
                    </th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('title')">
                        Title

                        @if ($sort == 'title')
                       
                        @if ($direction == 'asc')
                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                        @else
                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                        @endif
                        @else
                        <i class="fas fa-sort float-right"></i>
                        @endif
                      
                    </th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('content')">
                        Content
                        @if ($sort == 'content')
                       
                        @if ($direction == 'asc')
                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                        @else
                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                        @endif
                        @else
                        <i class="fas fa-sort float-right"></i>
                        @endif
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($posts as $item)
                <tr>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                          {{$item->id}}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                      <div class="text-sm text-gray-900">
                        {{$item->title}}
                      </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                      <div class="text-sm text-gray-900">
                        {{$item->content}}
                      </div>
                    </td>
                    <td class="px-6 py-4  text-sm font-medium">
                        {{--  @livewire('edit-post', ['post' => $post], key($post->id))  --}}
                        <a href="#" class="font-bold text-white py-2 px-4 rounded cursor-pointer  bg-green-600 hover:bg-green-500"
                              wire:click="edit({{$item}})">
                             <i class="fas fa-edit"></i>
                         </a>
                    </td>
                </tr>
                @endforeach
                <!-- More items... -->
            </tbody>
        </table>

        @if ($posts->hasPages())
              
           <div class="px-6 py-3">
             {{$posts->links()}}
           </div>

           @endif
            
        @else
            <div class="px-6 py-4">
              No existe ningún registro coincidente
            </div>
          @endif

          
        </x-table>

    </div>

    <x-jet-dialog-modal wire:model="open_edit">
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
          <x-jet-secondary-button wire:click="$set('open_edit', false)">
              Cancelar
          </x-jet-secondary-button>

          <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
              Actualizar
          </x-jet-danger-button>
      </x-slot>

  </x-jet-dialog-modal>
</div>
