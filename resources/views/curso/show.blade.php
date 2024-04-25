<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles del Curso
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ route('curso.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Volver al Listado</a>
                </div>
                <div>
                    <p class="font-semibold">ID: {{ $curso->id }}</p>
                    <p class="font-semibold">Codigo: {{ $curso->codigo }}</p>
                    <p class="font-semibold">Paralelo: {{ $curso->paralelo }}</p>
                    <p class="font-semibold">Nivel: {{ $curso->nivel }}</p>
                    <p class="font-semibold">Materias:</p>
                    <ul>
                        @foreach($materiasCurso as $materiaCurso)
                            <li>{{ $materiaCurso->materia->nombre }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
