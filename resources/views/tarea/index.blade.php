<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Tareas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Tareas') }}</h1>
                            <p class="mt-2 text-sm text-gray-700">Listado de todas las {{ __('tareas') }}.</p>
                        </div>
                        @role('profesor')
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('tarea.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Agregar tarea</a>
                        </div>
                        @endrole
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead class="bg-red-100">
                                        <tr>        
                                            <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>   
                                            <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Curso</th>
                                            <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Descripcion</th>                        
                                            <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fecha Publicacion</th>
                                            <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fecha Entrega</th>
                                            <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Archivo Adjunto</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Acciones</th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach ($tareas as $tarea)
                                            <tr class="even:bg-gray-50">
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $tarea->materiacurso->curso->codigo }} {{ $tarea->materiacurso->curso->paralelo }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $tarea->descripcion }}</td>  
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $tarea->fecha_publicacion }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $tarea->fecha_entrega }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <form action="{{ route('tarea.download', $tarea->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900" name="descargar" value="{{ $tarea->archivo_url }}">Descargar</button>
                                                    </form>
                                                </td>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                                    <form action="{{ route('tarea.destroy', $tarea->id) }}" method="POST">
                                                        <a href="{{ route('tarea.show', $tarea->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Ver') }}                                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-4 h-4 mr-1">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 12C8.25 9.92893 9.92893 8.25 12 8.25C14.0711 8.25 15.75 9.92893 15.75 12C15.75 14.0711 14.0711 15.75 12 15.75C9.92893 15.75 8.25 14.0711 8.25 12ZM12 9.75C10.7574 9.75 9.75 10.7574 9.75 12C9.75 13.2426 10.7574 14.25 12 14.25C13.2426 14.25 14.25 13.2426 14.25 12C14.25 10.7574 13.2426 9.75 12 9.75Z" fill="#00CC00"></path>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.32343 10.6464C3.90431 11.2503 3.75 11.7227 3.75 12C3.75 12.2773 3.90431 12.7497 4.32343 13.3536C4.72857 13.9374 5.33078 14.5703 6.09267 15.155C7.61978 16.3271 9.71345 17.25 12 17.25C14.2865 17.25 16.3802 16.3271 17.9073 15.155C18.6692 14.5703 19.2714 13.9374 19.6766 13.3536C20.0957 12.7497 20.25 12.2773 20.25 12C20.25 11.7227 20.0957 11.2503 19.6766 10.6464C19.2714 10.0626 18.6692 9.42972 17.9073 8.84497C16.3802 7.67292 14.2865 6.75 12 6.75C9.71345 6.75 7.61978 7.67292 6.09267 8.84497C5.33078 9.42972 4.72857 10.0626 4.32343 10.6464ZM5.17941 7.65503C6.90965 6.32708 9.31598 5.25 12 5.25C14.684 5.25 17.0903 6.32708 18.8206 7.65503C19.6874 8.32028 20.4032 9.06244 20.9089 9.79115C21.4006 10.4997 21.75 11.2773 21.75 12C21.75 12.7227 21.4006 13.5003 20.9089 14.2089C20.4032 14.9376 19.6874 15.6797 18.8206 16.345C17.0903 17.6729 14.684 18.75 12 18.75C9.31598 18.75 6.90965 17.6729 5.17941 16.345C4.31262 15.6797 3.59681 14.9376 3.0911 14.2089C2.59937 13.5003 2.25 12.7227 2.25 12C2.25 11.2773 2.59937 10.4997 3.0911 9.79115C3.59681 9.06244 4.31262 8.32028 5.17941 7.65503Z" fill="#00CC00"></path>
                                                        </svg>  </a>
                                                       @role('profesor')
                                                        <a href="{{ route('tarea.edit', $tarea->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('tarea.destroy', $tarea->id) }}" class="text-red-600 font-bold hover:text-red-900" onclick="event.preventDefault(); confirm('Seguro que quiere eliminar esta tarea?') ? this.closest('form').submit() : false;">{{ __('Delete') }}</a>
                                                    @endrole
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-4 px-4">
                                    {!! $tareas->withQueryString()->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
