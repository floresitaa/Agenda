<<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Profesor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('profesores.update', $profesor->id)}}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('nombre', $profesor->nombre) }}" required />
                    </div>

                    <div class="mb-4">
                        <label for="apellido" class="block text-gray-700 text-sm font-bold mb-2">Apellido:</label>
                        <input type="text" name="apellido" id="apellido" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('nombre', $profesor->apellido) }}" required />
                    </div>

                    <div class="mb-4">
                        <label for="ci" class="block text-gray-700 text-sm font-bold mb-2">CI:</label>
                        <input type="text" name="ci" id="ci" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('nombre', $profesor->ci) }}" required />
                    </div>

                    <div class="mb-4">
                        <label for="celular" class="block text-gray-700 text-sm font-bold mb-2">Celular:</label>
                        <input type="text" name="celular" id="celular" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('nombre', $profesor->celular) }}" required />
                    </div>

                    <div class="mb-4">
                        <label for="direccion" class="block text-gray-700 text-sm font-bold mb-2">Direccion:</label>
                        <input type="text" name="direccion" id="direccion" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('nombre', $profesor->direccion) }}" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>