<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-500 uppercase tracking-wider leading-tight">
            {{ __('Administración de Horarios') }}
        </h2>
    </x-slot>
    <div>
        <div class="shadow-lg">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                    <div class="px-2 py-2 shadow overflow-x-auto border-b border-gray-200 sm:rounded-lg ">
                        <div class="py-2 px-2 text-center">
                            <div class="align-middle min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                                <button type="button" onclick="window.location='{{ route('rats') }}'"
                                    class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    &nbsp⏏&nbspAdministrar RATS&nbsp&nbsp</button>
                                <button type="button" onclick="agregarModal()"
                                    class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    &nbsp✚&nbspNuevo Horario&nbsp&nbsp</button>

                            </div>
                        </div>
                        <table id="dataTable" class="min-divide-y divide-gray-200 stripe row-border">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Horario Traslado (INI)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Horario Traslado (FIN)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Horario Trabajo (INI)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Horario Trabajo (FIN)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Horario Salida (INI)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Horario Salida (FIN)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!--Agregar-->
<x-add-modal name="horarios-add-modal">
    <x-slot name="title">
        Nuevo horario 🆕
    </x-slot>
    <x-slot name="body">
        <form id="form_add" method="POST" action="/horarios">
            @csrf
            <div class="flex -mx-3 mb-6">
                <div class="md:w-1/2 px-3">
                    <x-jet-label for="h_hora_ini_traslado_add" value="{{ __('Hora INI Traslado') }}" class="mt-2" />
                    <input type="time" id="h_hora_ini_traslado_add" name="hora_ini_traslado">
                </div>
                <div class="md:w-1/2 px-3">
                    <x-jet-label for="h_hora_fin_traslado_add" value="{{ __('Hora FIN Traslado') }}" class="mt-2" />
                    <input type="time" id="h_hora_fin_traslado_add" name="hora_fin_traslado">
                </div>
            </div>
            <div class="flex -mx-3 mb-6">
                <div class="md:w-1/2 px-3">
                    <x-jet-label for="h_hora_ini_trabajo_add" value="{{ __('Hora INI Trabajo') }}" class="mt-2" />
                    <input type="time" id="h_hora_ini_trabajo_add" name="hora_ini_trabajo">
                </div>
                <div class="md:w-1/2 px-3">
                    <x-jet-label for="h_hora_fin_trabajo_add" value="{{ __('Hora FIN Trabajo') }}" class="mt-2" />
                    <input type="time" id="h_hora_fin_trabajo_add" name="hora_fin_trabajo">
                </div>
            </div>
            <div class="flex -mx-3 mb-6">
                <div class="md:w-1/2 px-3">
                    <x-jet-label for="h_hora_ini_salida_add" value="{{ __('Hora INI Salida') }}" class="mt-2" />
                    <input type="time" id="h_hora_ini_salida_add" name="hora_ini_salida">
                </div>
                <div class="md:w-1/2 px-3">
                    <x-jet-label for="h_hora_fin_salida_add" value="{{ __('Hora FIN Salida') }}" class="mt-2" />
                    <input type="time" id="h_hora_fin_salida_add" name="hora_fin_salida">
                </div>
            </div>
    </x-slot>
    <x-slot name="footer">
        <x-button id="btn_add"
            class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Guardar
            cambios</x-button>
        </form>
    </x-slot>
</x-add-modal>

<!--Editar-->
<x-edit-modal name="horarios-edit">
    <x-slot name="title" id="titulo_edit">
        Editando el Horario ✏
    </x-slot>
    <x-slot name="body">
        <form method="POST" action="/horarios/" id="form_edit">
            @csrf
            {{ method_field('PUT') }}
            <div class="flex -mx-3 mb-6">
                <div class="md:w-1/2 px-3">
                    <x-jet-label for="h_hora_ini_traslado_edit" value="{{ __('Hora INI Traslado') }}" class="mt-2" />
                    <input type="time" id="h_hora_ini_traslado_edit" name="hora_ini_traslado">
                </div>
                <div class="md:w-1/2 px-3">
                    <x-jet-label for="h_hora_fin_traslado_edit" value="{{ __('Hora FIN Traslado') }}" class="mt-2" />
                    <input type="time" id="h_hora_fin_traslado_edit" name="hora_fin_traslado">
                </div>
            </div>
            <div class="flex -mx-3 mb-6">
                <div class="md:w-1/2 px-3">
                    <x-jet-label for="h_hora_ini_trabajo_edit" value="{{ __('Hora INI Trabajo') }}" class="mt-2" />
                    <input type="time" id="h_hora_ini_trabajo_edit" name="hora_ini_trabajo">
                </div>
                <div class="md:w-1/2 px-3">
                    <x-jet-label for="h_hora_fin_trabajo_edit" value="{{ __('Hora FIN Trabajo') }}" class="mt-2" />
                    <input type="time" id="h_hora_fin_trabajo_edit" name="hora_fin_trabajo">
                </div>
            </div>
            <div class="flex -mx-3 mb-6">
                <div class="md:w-1/2 px-3">
                    <x-jet-label for="h_hora_ini_salida_edit" value="{{ __('Hora INI Salida') }}" class="mt-2" />
                    <input type="time" id="h_hora_ini_salida_edit" name="hora_ini_salida">
                </div>
                <div class="md:w-1/2 px-3">
                    <x-jet-label for="h_hora_fin_salida_edit" value="{{ __('Hora FIN Salida') }}" class="mt-2" />
                    <input type="time" id="h_hora_fin_salida_edit" name="hora_fin_salida">
                </div>
            </div>
    </x-slot>
    <x-slot name="footer">
        <x-button type="submit"
            class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Guardar cambios</x-button>
        </form>
    </x-slot>
</x-edit-modal>

<!--Eliminar-->
<x-delete-modal name="horarios-delete">
    <x-slot name="title">
        Eliminando Horario
    </x-slot>
    <x-slot name="body">
        <h1>¿Seguro desea eliminar el horario?</h1>
    </x-slot>
    <x-slot name="footer">
        <form method="POST" action="javascript:void(0)" id="form_delete">
            @csrf
            {{ method_field('DELETE') }}
            <x-button type="submit"
                class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Eliminar</x-button>
        </form>
    </x-slot>
</x-delete-modal>

<!--Detalles-->
<x-show-modal name="horarios-show">
    <x-slot name="title" id="titulo_show">
        Detalles del horario 👁‍🗨
    </x-slot>
    <x-slot name="body">
        <div class="flex -mx-3 mb-6">
            <div class="md:w-1/2 px-3">
                <x-jet-label for="h_hora_ini_traslado_show" value="{{ __('Hora INI Traslado') }}" class="mt-2" />
                <input type="time" id="h_hora_ini_traslado_show" name="hora_ini_traslado">
            </div>
            <div class="md:w-1/2 px-3">
                <x-jet-label for="h_hora_fin_traslado_show" value="{{ __('Hora FIN Traslado') }}" class="mt-2" />
                <input type="time" id="h_hora_fin_traslado_show" name="hora_fin_traslado">
            </div>
        </div>
        <div class="flex -mx-3 mb-6">
            <div class="md:w-1/2 px-3">
                <x-jet-label for="h_hora_ini_trabajo_show" value="{{ __('Hora INI Trabajo') }}" class="mt-2" />
                <input type="time" id="h_hora_ini_trabajo_show" name="hora_ini_trabajo">
            </div>
            <div class="md:w-1/2 px-3">
                <x-jet-label for="h_hora_fin_trabajo_show" value="{{ __('Hora FIN Trabajo') }}" class="mt-2" />
                <input type="time" id="h_hora_fin_trabajo_show" name="hora_fin_trabajo">
            </div>
        </div>
        <div class="flex -mx-3 mb-6">
            <div class="md:w-1/2 px-3">
                <x-jet-label for="h_hora_ini_salida_show" value="{{ __('Hora INI Salida') }}" class="mt-2" />
                <input type="time" id="h_hora_ini_salida_show" name="hora_ini_salida">
            </div>
            <div class="md:w-1/2 px-3">
                <x-jet-label for="h_hora_fin_salida_show" value="{{ __('Hora FIN Salida') }}" class="mt-2" />
                <input type="time" id="h_hora_fin_salida_show" name="hora_fin_salida">
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-show-modal>

<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#dataTable').DataTable({
            responsive: true,
            language: {
                url: '/js/datatable-es-cl.json'
            },
            processing: true,
            serverSide: true,
            ajax: '/getHorarios',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'hora_ini_traslado',
                    name: 'hora_ini_traslado'
                },
                {
                    data: 'hora_fin_traslado',
                    name: 'hora_fin_traslado'
                },
                {
                    data: 'hora_ini_trabajo',
                    name: 'hora_ini_trabajo'
                },
                {
                    data: 'hora_fin_trabajo',
                    name: 'hora_fin_trabajo'
                },
                {
                    data: 'hora_ini_salida',
                    name: 'hora_ini_salida'
                },
                {
                    data: 'hora_fin_salida',
                    name: 'hora_fin_salida'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                } //
            ],
            order: [
                [0, 'asc']
            ],
            pageLength: 25,
        });
    });

    function agregarModal() {
        $('#horarios-add-modal').toggle();
    }

    function editarModal(id) {
        $('#horarios-edit').toggle();
        $('#titulo_edit').text('Editando el Horario ' + id);
        $('#form_edit').attr('action', "/horarios/" + id);
        $.ajax({
            url: "/getHorario/" + id,
            success: function(result) {
                $("#h_hora_ini_traslado_edit").attr("value", result.hora_ini_traslado);
                $("#h_hora_fin_traslado_edit").attr("value", result.hora_fin_traslado);
                $("#h_hora_ini_trabajo_edit").attr("value", result.hora_ini_trabajo);
                $("#h_hora_fin_trabajo_edit").attr("value", result.hora_fin_trabajo);
                $("#h_hora_ini_salida_edit").attr("value", result.hora_ini_salida);
                $("#h_hora_fin_salida_edit").attr("value", result.hora_fin_salida);
            }
        });
    }

    function eliminarModal(id) {
        $("#horarios-delete").toggle();
        $("#form_delete").attr("action", "/horarios/" + id);
    }

    function detalleModal(id) {
        $("#horarios-show").toggle();
        $('#titulo_show').text('Detalles del Horario ID ' + id);
        $.ajax({
            url: "/getHorario/" + id,
            success: function(result) {
                $("#h_hora_ini_traslado_show").attr("value", result.hora_ini_traslado);
                $("#h_hora_fin_traslado_show").attr("value", result.hora_fin_traslado);
                $("#h_hora_ini_trabajo_show").attr("value", result.hora_ini_trabajo);
                $("#h_hora_fin_trabajo_show").attr("value", result.hora_fin_trabajo);
                $("#h_hora_ini_salida_show").attr("value", result.hora_ini_salida);
                $("#h_hora_fin_salida_show").attr("value", result.hora_fin_salida);
            }
        });
    }
</script>
