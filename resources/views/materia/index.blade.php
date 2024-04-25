<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Materias
        </h2>
    </x-slot>
    <x-slot name="header">
        <a href="{{ route('materia.create') }}" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Agregar Materia</a>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="w-full whitespace-nowrap divide-y divide-gray-200">
                    <thead class="bg-red-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 sm:w-20">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500">NOMBRE</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $materias = $materias->sortBy('id');
                        @endphp

                        @foreach ($materias as $materia)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $materia->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $materia->nombre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-start items-center">
                                    <div class="flex justify-start">
                                        <a href="{{ route('materia.edit', $materia->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('materia.destroy', $materia->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Está seguro de que desea eliminar esta materia?')">
                                                <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>