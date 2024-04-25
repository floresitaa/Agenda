<x-app-layout>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Agenda</title>
        <!-- Tailwind CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="antialiased bg-white">

        <section class="mt-20">
            <!-- Contenedor principal -->
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- Componente -->
                <div class="grid grid-cols-1 gap-12 sm:gap-20 lg:grid-cols-1">
                    <!-- División del encabezado -->
                    <div class="max-w-lg">
                        <h1 class="mb-8 text-4xl "> <span class="text-700">U.E. Santa Rosa de Lima Fe y Alegria</span></h1>
                        <p class="mb-8 text-lg text-gray-700"> La unidad Edicativa Santa Rosa de Lima fue fundado por la Hermana Christa kitsch contando con el respaldo del convento de las Hermanas Dominicas de Cantalina de Siena de Arenberg de Alemana  </p>
                        <p class="mb-8 text-lg text-gray-700">Bienvenidos ......... </p>
                        <!-- Botones -->
                    </div>

                    <!-- División de la imagen -->
                    {{-- <div class="relative w-full h-80">
                        <img src="{{ asset('images/inicio.png') }}" class="object-cover w-full h-full rounded-lg shadow-xl" alt="Imagen de fondo" />
                    </div> --}}
                </div>
            </div>
        </section>
    </body>
</x-app-layout>
