<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-500 uppercase tracking-wider leading-tight">
            {{ __('Administración de Clientes') }}
        </h2>
    </x-slot>
    <div>
        <div class="shadow-lg">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                    <div class="px-2 py-2 shadow overflow-x-auto border-b border-gray-200 sm:rounded-lg ">
                        <div class="py-2 px-2 text-center">
                            <div class="align-middle min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                                <button type="button" onclick="agregarModal()"
                                    class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    &nbsp✚&nbspNuevo Cliente&nbsp&nbsp</button>
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
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Rut
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
<x-add-modal name="cliente-add-modal">
    <x-slot name="title">
    </x-slot>
    <x-slot name="body">
        <div class="mt-5 mb-10">
            <div class="text-center font-serif text-3xl underline underline-offset-4">-- Nuevo Cliente --
            </div>
        </div>
        <form id="form_add" method="POST" action="/clientes">
            @csrf
            <div class="lg:grid ld:grid-cols-3 md:grid md:grid-cols-2 sm:flex sm:flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <x-jet-label for="c_name_add" value="{{ __('Nombre') }}" />
                    <x-jet-input id="c_name_add" class="block mt-1 w-full" type="text" name="name" value=""
                        required placeholder="Nombre" />
                </div>
                <div class="w-full px-3 pt-2">
                    <x-jet-label for="c_rut_add" value="{{ __('Rut (sin puntos ni guión)') }}" />
                    <x-jet-input id="c_rut_add" class="block mt-1 w-full" type="number" name="rut" value=""
                        placeholder="Rut (sin puntos ni guión)" />
                </div>
                <div class="w-full px-3 pt-2">
                    <x-jet-label for="c_email_empresa_add" value="{{ __('Correo') }}" class="mt-2" />
                    <x-jet-input id="c_email_empresa_add" class="block mt-2 w-full" type="text" name="email_empresa"
                        placeholder="Correo" />
                </div>
                <div class="w-full px-3 pt-2">
                    <x-jet-label for="c_razon_social_add" value="{{ __('Razón Social') }}" class="mt-2" />
                    <x-jet-input id="c_razon_social_add" class="block mt-2 w-full" type="text" name="razon_social"
                        placeholder="Razón Social" />
                </div>
                <div class="w-full px-3 pt-2">
                    <x-jet-label for="c_direccion_add" value="{{ __('Dirección') }}" class="mt-2" />
                    <x-jet-input id="c_direccion_add" class="block mt-2 w-full" type="text" name="direccion"
                        placeholder="Dirección" />
                </div>
                <div class="w-full px-3 pt-2">
                    <x-jet-label for="c_ciudad_add" value="{{ __('Ciudad') }}" class="mt-2" />
                    <x-jet-input id="c_ciudad_add" class="block mt-2 w-full" type="text" name="ciudad"
                        placeholder="Ciudad" />
                </div>
                <div class="w-full px-3 pt-2">
                    <x-jet-label for="c_comuna_add" value="{{ __('Comuna') }}" class="mt-2" />
                    <x-jet-input id="c_comuna_add" class="block mt-2 w-full" type="text" name="comuna"
                        placeholder="Comuna" />
                </div>
            </div>

    </x-slot>
    <x-slot name="footer">
        <x-button id="btn_add"
            class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Guardar cambios
        </x-button>
        </form>
    </x-slot>

</x-add-modal>

<!--Editar-->
<x-edit-modal name="cliente-edit">
    <x-slot name="title" id="titulo_edit">
    </x-slot>
    <x-slot name="body">
        <div class="mt-5 mb-10">
            <div class="text-center font-serif text-3xl underline underline-offset-4">-- Editando al Cliente ✏ --
            </div>
        </div>
        <form method="POST" action="/clientes/" id="form_edit">
            @csrf
            {{ method_field('PUT') }}
            <div class="lg:grid ld:grid-cols-3 md:grid md:grid-cols-2 sm:flex sm:flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <x-jet-label for="c_name_edit" value="{{ __('Nombre') }}" />
                    <x-jet-input id="c_name_edit" class="block mt-1 w-full" type="text" name="name"
                        value="" required placeholder="Nombre" />
                </div>
                <div class="w-full px-3 pt-2">
                    <x-jet-label for="c_rut_edit" value="{{ __('Rut (sin puntos ni guión)') }}" />
                    <x-jet-input id="c_rut_edit" class="block mt-1 w-full" type="number" name="rut"
                        value="" placeholder="Rut (sin puntos ni guión)" />
                </div>
                <div class="w-full px-3 pt-2">
                    <x-jet-label for="c_email_empresa_edit" value="{{ __('Correo') }}" class="mt-2" />
                    <x-jet-input id="c_email_empresa_edit" class="block mt-2 w-full" type="text"
                        name="email_empresa" placeholder="Correo" />
                </div>
                <div class="w-full px-3 pt-2">
                    <x-jet-label for="c_razon_social_edit" value="{{ __('Razón Social') }}" class="mt-2" />
                    <x-jet-input id="c_razon_social_edit" class="block mt-2 w-full" type="text"
                        name="razon_social" placeholder="Razón Social" />
                </div>
                <div class="w-full px-3 pt-2">
                    <x-jet-label for="c_direccion_edit" value="{{ __('Dirección') }}" class="mt-2" />
                    <x-jet-input id="c_direccion_edit" class="block mt-2 w-full" type="text" name="direccion"
                        placeholder="Dirección" />
                </div>
                <div class="w-full px-3 pt-2">
                    <x-jet-label for="c_ciudad_edit" value="{{ __('Ciudad') }}" class="mt-2" />
                    <x-jet-input id="c_ciudad_edit" class="block mt-2 w-full" type="text" name="ciudad"
                        placeholder="Ciudad" />
                </div>
                <div class="w-full px-3 pt-2">
                    <x-jet-label for="c_comuna_edit" value="{{ __('Comuna') }}" class="mt-2" />
                    <x-jet-input id="c_comuna_edit" class="block mt-2 w-full" type="text" name="comuna"
                        placeholder="Comuna" />
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
<x-delete-modal name="cliente-delete">
    <x-slot name="title">
        Eliminando al Cliente
    </x-slot>
    <x-slot name="body">
        <h1>¿Seguro desea eliminar al cliente?</h1>
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
<x-show-modal name="cliente-show">
    <x-slot name="title" id="titulo_show">
    </x-slot>
    <x-slot name="body">
        <div class="mt-5 mb-10">
            <div class="text-center font-serif text-3xl underline underline-offset-4">-- Detalles del Cliente 👁‍🗨 --
            </div>
        </div>
        <div class="lg:grid ld:grid-cols-3 md:grid md:grid-cols-2 sm:flex sm:flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-jet-label for="c_name_show" value="{{ __('Nombre') }}" />
                <x-jet-input id="c_name_show" class="block mt-1 w-full" type="text" name="name"
                    value="" readOnly placeholder="Nombre" />
            </div>
            <div class="w-full px-3 pt-2">
                <x-jet-label for="c_rut_show" value="{{ __('Rut (sin puntos ni guión)') }}" />
                <x-jet-input id="c_rut_show" class="block mt-1 w-full" type="number" name="rut" value=""
                    placeholder="Rut (sin puntos ni guión)" readOnly/>
            </div>
            <div class="w-full px-3 pt-2">
                <x-jet-label for="c_email_empresa_show" value="{{ __('Correo') }}" class="mt-2" />
                <x-jet-input id="c_email_empresa_show" class="block mt-2 w-full" type="text" name="email_empresa"
                    placeholder="Correo" readOnly/>
            </div>
            <div class="w-full px-3 pt-2">
                <x-jet-label for="c_razon_social_show" value="{{ __('Razón Social') }}" class="mt-2" />
                <x-jet-input id="c_razon_social_show" class="block mt-2 w-full" type="text" name="razon_social"
                    placeholder="Razón Social" readOnly/>
            </div>
            <div class="w-full px-3 pt-2">
                <x-jet-label for="c_direccion_show" value="{{ __('Dirección') }}" class="mt-2" />
                <x-jet-input id="c_direccion_show" class="block mt-2 w-full" type="text" name="direccion"
                    placeholder="Dirección" readOnly/>
            </div>
            <div class="w-full px-3 pt-2">
                <x-jet-label for="c_ciudad_show" value="{{ __('Ciudad') }}" class="mt-2" />
                <x-jet-input id="c_ciudad_show" class="block mt-2 w-full" type="text" name="ciudad"
                    placeholder="Ciudad" readOnly/>
            </div>
            <div class="w-full px-3 pt-2">
                <x-jet-label for="c_comuna_show" value="{{ __('Comuna') }}" class="mt-2" />
                <x-jet-input id="c_comuna_show" class="block mt-2 w-full" type="text" name="comuna"
                    placeholder="Comuna" readOnly/>
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
            ajax: '/getClientes',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'rut',
                    name: 'rut'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                } //
            ],
            order: [
                [1, 'asc']
            ],
            pageLength: 25,
        });
    });

    function agregarModal() {
        $('#cliente-add-modal').toggle();
    }

    function editarModal(id) {
        $('#cliente-edit').toggle();
        $('#titulo_edit').text('Editando al cliente ' + id);
        $('#form_edit').attr('action', "/clientes/" + id);
        $.ajax({
            url: "/getCliente/" + id,
            success: function(result) {
                $("#c_name_edit").attr("value", result.name);
                $("#c_email_empresa_edit").attr("value", result.email_empresa);
                $("#c_rut_edit").attr("value", result.rut);
                $("#c_razon_social_edit").attr("value", result.razon_social);
                $("#c_direccion_edit").attr("value", result.direccion);
                $("#c_ciudad_edit").attr("value", result.ciudad);
                $("#c_comuna_edit").attr("value", result.comuna);
            }
        });
    }

    function eliminarModal(id) {
        $("#cliente-delete").toggle();
        $("#form_delete").attr("action", "/clientes/" + id);
        $.ajax({
            url: "/getCliente/" + id,
            success: function(result) {
                $('#c_name_delete').attr("value", result.name);
            }
        });
    }

    function detalleModal(id) {
        $("#cliente-show").toggle();
        $('#titulo_show').text('Detalles del cliente ID ' + id);
        $.ajax({
            url: "/getCliente/" + id,
            success: function(result) {
                $("#c_name_show").attr("value", result.name);
                $("#c_email_empresa_show").attr("value", result.email_empresa);
                $("#c_rut_show").attr("value", result.rut);
                $("#c_razon_social_show").attr("value", result.razon_social);
                $("#c_direccion_show").attr("value", result.direccion);
                $("#c_ciudad_show").attr("value", result.ciudad);
                $("#c_comuna_show").attr("value", result.comuna);
            }
        });
    }
</script>
