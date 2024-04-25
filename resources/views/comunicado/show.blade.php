<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $comunicado->name ?? __('Show') . " " . __('Comunicado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Show') }} Comunicado</h1>
                            <p class="mt-2 text-sm text-gray-700">Detalles del {{ __('Comunicado') }}.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('comunicados.index') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">atras</a>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <div class="mt-6 border-t border-gray-100">
                                    <dl class="divide-y divide-gray-100">
                                        
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Nombre</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $comunicado->nombre }}</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Descripcion</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $comunicado->descripcion }}</dd>
                                </div>
                                <div class="md:w-1/2 mt-4 md:mt-0">
                                    @if (Str::contains($comunicado->archivo_url, ['.jpg', '.jpeg', '.png', '.gif', '.bmp']))
                                        <img class="mx-auto" style="max-height: 300px; max-width: 500px;" src="{{ asset('storage/archivos/comunicados/' . basename($comunicado->archivo_url)) }}" alt="">
                                    @elseif (Str::contains($comunicado->archivo_url, ['.mp4', '.mov', '.avi']))
                                        <video class="mx-auto" style="max-height: 300px; max-width: 500px;" controls>
                                            <source src="{{ asset('storage/archivos/comunicados/' . basename($comunicado->archivo_url)) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        <a href="{{ asset('storage/archivos/comunicados/' . basename($comunicado->archivo_url)) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{ $comunicado->archivo_url }}</a>
                                    @endif
                                </div>
                                

                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
