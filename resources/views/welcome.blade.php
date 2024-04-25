<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="antialiased bg-white">
    <nav class="bg-red-700 text-white">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <a href="#" class="flex items-center">
                        <img class="h-8" src="{{ asset('images/Liceo.jpg') }}" alt="LiceoLogo">
                        <span class="ml-2 text-xl font-semibold">U.E. Santa Rosa de Lima Fe y Alegria </span>
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="flex items-center ml-4">
                        <a href="#" class="px-3 py-2 text-white font-medium hover:bg-red-600 rounded">Inicio</a>
                        <a href="#" class="px-3 py-2 text-white font-medium hover:bg-red-600 rounded">Nosotros</a>
                        <a href="#" class="px-3 py-2 text-white font-medium hover:bg-red-600 rounded">Servicios</a>

                        <a href="#" class="px-3 py-2 text-white font-medium hover:bg-red-600 rounded">Contactos</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <section class="mt-20">
        <!-- Contenedor principal -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Componente -->
            <div class="grid grid-cols-1 gap-12 sm:gap-20 lg:grid-cols-2">
                <!-- División del encabezado -->
                <div class="max-w-lg">
                    <h1 class="mb-6 text-4xl font-semibold md:text-6xl"> <span class="text-red-700">U.E. Isabel Villegas Mariscal</span></h1>
                    <p class="mb-8 text-lg text-gray-700">La unidad educativa Liceo Isabel Villegas Mariscal se encuentra ubicada en el Barrio Obrero, en la avenida Cardenal Julio Terrazas, frente al parque infantil, esta unidad educativa fue fundada un 17 de agosto del año 1956, durante la presidencia de Víctor Paz Estensoro, con el propósito de formar integralmente a la juventud femenina de este ilustre pueblo.</p>
                    <p class="mb-8 text-lg text-gray-700">¡Bienvenido a la agenda web!</p>
                    <!-- Botones -->
                    <div class="flex">
                        <a href="{{ route('login') }}" class="mr-4 inline-block px-8 py-4 text-lg font-semibold text-white bg-red-700 rounded-lg shadow-md hover:bg-red-800">Iniciar Sesión</a>

                    </div>
                </div>
                <!-- División de la imagen -->
                <div class="relative w-full h-80">
                    <img src="{{ asset('images/inicio.png') }}" class="object-cover w-full h-full rounded-lg shadow-xl" alt="Imagen de fondo" />
                </div>
            </div>
        </div>
    </section>
</body>
</html>
