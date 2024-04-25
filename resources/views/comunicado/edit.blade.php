<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Comunicado
        </h2>
    </x-slot>

    <div class="py-6 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('comunicado.update', $comunicado->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" value="{{ $comunicado->nombre }}" required>
                        @error('nombre')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" required>{{ $comunicado->descripcion }}</textarea>
                        @error('descripcion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="archivo_url" class="block text-gray-700 text-sm font-bold mb-2">Archivo:</label>
                        <input type="file" name="archivo_url" id="archivo_url" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                        @if ($comunicado->archivo_url)
                            <div class="mt-2">
                                @if (Str::contains($comunicado->archivo_url, ['.jpg', '.jpeg', '.png', '.gif', '.bmp']))
                                    <img src="{{ asset('archivos/comunicados/' . basename($comunicado->archivo_url)) }}" alt="Archivo" style="max-width: 200px; max-height: 200px;">
                                @elseif (Str::contains($comunicado->archivo_url, ['.mp4', '.mov', '.avi']))
                                    <video controls style="max-width: 200px; max-height: 200px;">
                                        <source src="{{ asset('archivos/comunicados/' . basename($comunicado->archivo_url)) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <a href="{{ asset('archivos/comunicados/' . basename($comunicado->archivo_url)) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{ basename($comunicado->archivo_url) }}</a>
                                @endif
                            </div>
                        @endif
                        @error('archivo_url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Actualizar Comunicado
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
