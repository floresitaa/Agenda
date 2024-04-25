<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Tarea
        </h2>
    </x-slot>

    <div class="py-6 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('tarea.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="fecha_publicacion" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Inicio:</label>
                        <input type="date" name="fecha_publicacion" id="fecha_publicacion" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" value="{{ old('fecha_publicacion') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="fecha_entrega" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Entrega:</label>
                        <input type="date" name="fecha_entrega" id="fecha_entrega" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" value="{{ old('fecha_entrega') }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" rows="3" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" required>{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="estado" class="block text-gray-700 text-sm font-bold mb-2">Estado:</label>
                        <textarea name="estado" id="estado" rows="3" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" required>{{ old('estado') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="archivo_url" class="block text-gray-700 text-sm font-bold mb-2">Archivo:</label>
                        <input type="file" name="archivo_url" id="archivo_url" accept="image/*,.txt,.pdf,.docx,.mp4,.mov,.avi" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" required>
                        @error('archivo_url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="materiacurso_id" class="block text-gray-700 text-sm font-bold mb-2">Materia:</label>
                        <select wire:model="materiacurso_id" name="materiacurso_id" id="materiacurso_id" class="form-input rounded-md shadow-sm w-96">
                            <option value="0">Sin Materias</option>
                            @foreach ($materias as $materia)
                            <option value="{{ $materia->id }}">{{ $materia->materia->nombre}} | Curso: {{ $materia->curso->codigo}} | Paralelo: {{ $materia->curso->paralelo}} | Docente: {{ $materia->profesor->nombre ?? 'Sin docente'}}</option>
                            @endforeach
                        </select>
                        @error('materiacurso_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Crear Tarea
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
