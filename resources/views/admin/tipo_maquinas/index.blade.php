<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-500 uppercase tracking-wider leading-tight">
            {{ __('Administración en Tipos de Maquina') }}
        </h2>
    </x-slot>
    <div>
        <div class="shadow-lg">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                    <div class="px-2 py-2 shadow overflow-x-auto border-b border-gray-200 sm:rounded-lg ">
                        <div class="py-2 px-2 text-center">
                            <div class="align-middle inline-block min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                                <button type="button" onclick="window.location='{{ route('maquinas') }}'"
                                    class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    &nbsp⏏&nbspMaquinas&nbsp&nbsp</button>

                                <button type="button" onclick="agregarModal()"
                                    class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    &nbsp✚&nbspNuevo Tipo&nbsp&nbsp</button>

                            </div>
                        </div>
                        <table id="dataTable" class="min-w-full divide-y divide-gray-200 stripe row-border">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
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
<x-add-modal name="tipo-maquinas-add-modal">
    <x-slot name="title">
        Nuevo Tipo de Maquina 🆕
    </x-slot>
    <x-slot name="body">
        <form id="form_add" method="POST" action="/tipo_maquinas">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 pt-2 md:mb-0">
                    <x-jet-label for="tm_name_add" value="{{ __('Nombre') }}" />
                    <x-jet-input id="tm_name_add" class="block mt-1 w-full" type="text" name="name" value=""
                        required />
                </div>
            </div>
    </x-slot>
    <x-slot name="footer">
        <x-button id="btn_add"
            class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Guardar
            cambios</x-button>
        </form>
    </x-slot>

</x-add-modal>

<!--Editar-->
<x-edit-modal name="tipo-maquinas-edit">
    <x-slot name="title" id="titulo_edit">
        Editando Tipo de Maquina ✏
    </x-slot>
    <x-slot name="body">
        <form method="POST" action="/tipo_maquinas/" id="form_edit">
            @csrf
            {{ method_field('PUT') }}
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 pt-2 md:mb-0">
                    <x-jet-label for="tm_name_edit" value="{{ __('Nombre') }}" />
                    <x-jet-input id="tm_name_edit" class="block mt-1 w-full" type="text" name="name"
                        value="" required />
                </div>
            </div>
    </x-slot>
    <x-slot name="footer">
        <x-button type="submit"
            class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Guardar cambios</x-button>
        </form>

    </x-slot>
</x-edit-modal>

<!--Eliminar-->
<x-delete-modal name="tipo-maquinas-delete">
    <x-slot name="title">
        Eliminando Tipo de Maquina
    </x-slot>
    <x-slot name="body">
        <h1>¿Seguro desea eliminar este tipo de maquina?</h1>
    </x-slot>
    <x-slot name="footer">
        <form method="POST" action="javascript:void(0)" id="form_delete">
            @csrf
            {{ method_field('DELETE') }}
            <x-button type="submit"
                class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Eliminar</x-button>
        </form>
    </x-slot>
</x-delete-modal>

<!--Detalles-->
<x-show-modal name="tipo-maquinas-show">
    <x-slot name="title" id="titulo_show">
        Detalles del Tipo de Maquina 👁‍🗨
    </x-slot>
    <x-slot name="body">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 pt-2 md:mb-0">
                <x-jet-label for="tm_name_show" value="{{ __('Nombre') }}" />
                <x-jet-input id="tm_name_show" class="block mt-1 w-full" type="text" name="name" value=""
                    required readonly />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 pt-2 md:mb-0">
                <x-jet-label for="tm_created_at_show" value="{{ __('Fecha de creación') }}" />
                <x-jet-input id="tm_created_at_show" class="block mt-1 w-full" type="text" name="created_at"
                    value="" required readonly />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="tm_updated_at_show" value="{{ __('Fecha ult. actualización') }}" class="mt-2" />
                <x-jet-input id="tm_updated_at_show" class="block mt-2 w-full" type="text" name="updated_at"
                    readonly />
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
            ajax: '/getTipoMaquinas',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
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
        $('#tipo-maquinas-add-modal').toggle();
    }

    function editarModal(id) {
        $('#tipo-maquinas-edit').toggle();
        $('#titulo_edit').text('Editando Tipo de Maquina ID ' + id);
        $('#form_edit').attr('action', "/tipo_maquinas/" + id);
        $.ajax({
            url: "/getTipoMaquina/" + id,
            success: function(result) {
                $("#tm_name_edit").attr("value", result.name);
            }
        });
    }

    function eliminarModal(id) {
        $("#tipo-maquinas-delete").toggle();
        $("#form_delete").attr("action", "/tipo_maquinas/" + id);
    }

    function detalleModal(id) {
        $("#tipo-maquinas-show").toggle();
        $('#titulo_show').text('Detalles del Tipo de Maquina ID ' + id);
        $.ajax({
            url: "/getTipoMaquina/" + id,
            success: function(result) {
                $("#tm_name_show").attr("value", result.name);
                $("#tm_created_at_show").attr("value", result.created_at);
                $("#tm_updated_at_show").attr("value", result.updated_at);
            }
        });
    }
</script>
