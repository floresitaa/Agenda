<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Comunicado
        </h2>
    </x-slot>

    <div class="py-6 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('comunicado.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" rows="3" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" required>{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="archivo_url" class="block text-gray-700 text-sm font-bold mb-2">Archivo:</label>
                        <input type="file" name="archivo_url" id="archivo_url" accept="image/*,.txt,.pdf,.docx,.mp4,.mov,.avi" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" required>
                        @error('archivo_url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Crear Comunicado
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
