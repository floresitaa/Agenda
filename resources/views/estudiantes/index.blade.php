<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Estudiantes
        </h2>
    </x-slot>

    <div class="py-6 bg-white">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('estudiantes.import.excel') }}" method="post" enctype="multipart/form-data"
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
                    <a href="{{ route('estudiantes.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150">
                        Crear alumno
                    </a>
                </div>
            
                <input type="file" name="file"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mr-2"
                    required>
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 font-semibold py-2 px-4 rounded border border-red-900 border-solid text-white">
                    Importar alumnos
                </button>            
            </form>

            <div class="overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full bg-white">
                        <thead class="bg-red-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    Apellido</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    CI</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    Rude</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    Dirección</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    Curso</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    Tutor 1 CI</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                    Tutor 2 CI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($estudiantes as $estudiante)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $estudiante->nombre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $estudiante->apellido }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $estudiante->ci }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $estudiante->rude }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $estudiante->direccion}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $estudiante->curso->codigo }} {{ $estudiante->curso->paralelo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $estudiante->tutor1_ci }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $estudiante->tutor2_ci }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{ route('estudiantes.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150">
                    Crear alumno
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
