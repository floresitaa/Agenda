<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Evento en el Calendario
        </h2>
    </x-slot>

    <div class="py-6 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('calendario.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="event" class="block text-gray-700 text-sm font-bold mb-2">Evento:</label>
                        <input type="text" name="event" id="event" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" value="{{ old('event') }}" required>
                        @error('event')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="start_event" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Inicio del Evento:</label>
                        <input type="date" name="start_event" id="start_event" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" value="{{ old('start_event') }}" required>
                        @error('start_event')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="end_event" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Fin del Evento:</label>
                        <input type="date" name="end_event" id="end_event" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" value="{{ old('end_event') }}" required>
                        @error('end_event')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Crear Evento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
