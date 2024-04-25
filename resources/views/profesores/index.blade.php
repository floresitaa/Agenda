<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Profesores
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('profesors.import.excel') }}" method="post" enctype="multipart/form-data"
                class="flex items-center justify-center mb-6">
                @csrf
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="inline-block">
                    <a href="{{ route('profesores.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150">
                        Crear Profesor
                    </a>
                </div>
            
                <input type="file" name="file"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mr-2"
                    required>
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 font-semibold py-2 px-4 rounded border border-red-900 border-solid text-white">
                    Importar profesores
                </button>
            </form>

            <div class="bg-white-300 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-red-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    CI</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    Celular</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    Dirección</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($profesores as $profesor)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $profesor->ci }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $profesor->nombre }} {{ $profesor->apellido }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $profesor->celular }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $profesor->direccion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $profesor->user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-start">
                                        <a href="{{ route('profesores.asignar', $profesor->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                                                <path fill="currentColor" fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14m.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-xs text-gray-500">Asignar Materias</span>
                                        </a>
                                        <form action="{{ route('profesores.eliminar-materias-asignadas', $profesor->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Está seguro de que desea eliminar esta materia?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                </svg>
                                                <span class="text-xs text-gray-500">Eliminar Materias</span>
                                            </button>
                                        </form>

                                        <a href="{{ route('profesores.edit', $profesor->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Está seguro de que desea eliminar esta materia?')">
                                                <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    {{-- Aquí puedes añadir acciones como editar o eliminar --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
