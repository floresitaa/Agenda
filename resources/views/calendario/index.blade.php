<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario</title>

  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>

</head>
<body>

  <x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Calendario
      </h2>
    </x-slot>
    
    <div class="py-6 bg-white">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify mt-4">
          @role('admin')
          <a href="{{ route('calendario.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150">
              Registrar Nuevo
          </a>
          @endrole
      </div>
      @role('admin')
      <div class="overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead class="bg-red-100" >
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evento</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inicio del Evento</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fin del Evento</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($eventos as $event)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $event->event }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($event->start_event)->format('d/m/Y') }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($event->end_event)->format('d/m/Y') }}</td>                  
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('calendario.edit', $event->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg></a>
                        <form id="deleteForm_{{ $event->id }}" action="{{ route('calendario.destroy', $event->id) }}" method="POST" class="inline">
                          @csrf
                          @method('DELETE')
                          <button type="button" onclick="confirmDelete({{ $event->id }})" class="text-red-600 hover:text-red-900"><svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg></button>
                      </form>
                      <script>
                          function confirmDelete(eventId) {
                              if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
                                  document.getElementById('deleteForm_' + eventId).submit();
                              }
                          }
                      </script>
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
    @endrole
 
      </div>
      @role('profesor')
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg p-6">
        <div id="calendar"></div>
      </div>
      @endrole
      @role('tutor')
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg p-6">
        <div id="calendar"></div>
      </div>
      @endrole
      @role('alumno')
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg p-6">
        <div id="calendar"></div>
      </div>
      @endrole
    </div>
  </x-app-layout>

  <script>
    document.addEventListener('DOMContentLoaded', function() {

      const calendarEl = document.getElementById('calendar');

      const calendar = new FullCalendar.Calendar(calendarEl, {
        
        initialView: 'dayGridMonth', // Vista inicial (puedes cambiar a 'dayGridMonth', 'list', etc.)
        events: @json($events),
        selectable: true,
        locale: 'es'        
      });
      calendar.render();
    });
  </script>
</body>
</html>
