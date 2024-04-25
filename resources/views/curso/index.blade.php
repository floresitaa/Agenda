<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Cursos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('curso.create') }}" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Agregar Curso</a>
            </div>
            <div class="overflow-x-auto bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="w-full whitespace-nowrap divide-y divide-gray-200">
                    <thead class="bg-red-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500">Codigo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500">Paralelo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500">Nivel</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($cursos as $curso)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $curso->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $curso->codigo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $curso->paralelo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $curso->nivel }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
                                    <a href="{{ route('curso.show', $curso->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-4 h-4 mr-1">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 12C8.25 9.92893 9.92893 8.25 12 8.25C14.0711 8.25 15.75 9.92893 15.75 12C15.75 14.0711 14.0711 15.75 12 15.75C9.92893 15.75 8.25 14.0711 8.25 12ZM12 9.75C10.7574 9.75 9.75 10.7574 9.75 12C9.75 13.2426 10.7574 14.25 12 14.25C13.2426 14.25 14.25 13.2426 14.25 12C14.25 10.7574 13.2426 9.75 12 9.75Z" fill="#00CC00"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.32343 10.6464C3.90431 11.2503 3.75 11.7227 3.75 12C3.75 12.2773 3.90431 12.7497 4.32343 13.3536C4.72857 13.9374 5.33078 14.5703 6.09267 15.155C7.61978 16.3271 9.71345 17.25 12 17.25C14.2865 17.25 16.3802 16.3271 17.9073 15.155C18.6692 14.5703 19.2714 13.9374 19.6766 13.3536C20.0957 12.7497 20.25 12.2773 20.25 12C20.25 11.7227 20.0957 11.2503 19.6766 10.6464C19.2714 10.0626 18.6692 9.42972 17.9073 8.84497C16.3802 7.67292 14.2865 6.75 12 6.75C9.71345 6.75 7.61978 7.67292 6.09267 8.84497C5.33078 9.42972 4.72857 10.0626 4.32343 10.6464ZM5.17941 7.65503C6.90965 6.32708 9.31598 5.25 12 5.25C14.684 5.25 17.0903 6.32708 18.8206 7.65503C19.6874 8.32028 20.4032 9.06244 20.9089 9.79115C21.4006 10.4997 21.75 11.2773 21.75 12C21.75 12.7227 21.4006 13.5003 20.9089 14.2089C20.4032 14.9376 19.6874 15.6797 18.8206 16.345C17.0903 17.6729 14.684 18.75 12 18.75C9.31598 18.75 6.90965 17.6729 5.17941 16.345C4.31262 15.6797 3.59681 14.9376 3.0911 14.2089C2.59937 13.5003 2.25 12.7227 2.25 12C2.25 11.2773 2.59937 10.4997 3.0911 9.79115C3.59681 9.06244 4.31262 8.32028 5.17941 7.65503Z" fill="#00CC00"></path>
                                        </svg>                                                                              
                                    </a>
                                    <a href="{{ route('curso.edit', $curso->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('curso.destroy', $curso->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Está seguro de que desea eliminar este curso?')"><svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
