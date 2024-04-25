<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold">Asignar Materia</h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('profesores.asignar', ['id' => $profesores->id]) }}" enctype="multipart/form-data">   
                    @csrf
                    <div class="bg-gray-100 p-4 mb-4">
                        <p class="font-bold">Profesor:</p>
                        <p>Nombre: {{ $profesores->nombre }}</p>
                        <p>CI: {{ $profesores->ci }}</p>
                    </div>

                    <div class="form-group">
                        <label for="detalles">Asignar Materias</label>
                        <div id="materias">
                            <div class="row materia-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="materia">Materia</label>
                                        @foreach ($materias as $materia)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="materiacurso[]" value="{{ $materia->id }}">
                                                    {{ $materia->materia->nombre }} | Curso: {{ $materia->curso->codigo }} | Paralelo: {{ $materia->curso->paralelo }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
        
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger eliminar-detalle">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
        
                    </div>
                    
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#agregar_materia').click(function(e) {
            e.preventDefault();
            var materiaRow = $('.materia-row:first').clone(true);
            materiaRow.find('input').val('');
            $('#materias').append(materiaRow);
        });

        $('.eliminar-detalle').click(function(e) {
            e.preventDefault();
            if ($('.materia-row').length > 1) {
                $(this).closest('.materia-row').remove();
            }
        });
    });
</script>
