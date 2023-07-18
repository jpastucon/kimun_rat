<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-500 uppercase tracking-wider leading-tight">
            {{ __('Administración de Contactos') }}
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
                                    &nbsp✚&nbspNuevo Contacto&nbsp&nbsp</button>
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
                                        Cliente
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
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
<x-add-modal name="contactos-add-modal">
    <x-slot name="title">
    </x-slot>
    <x-slot name="body">
        <div class="mt-5 mb-10">
            <div class="text-center font-serif text-3xl underline underline-offset-4">-- Nuevo Contacto --
            </div>
        </div>
        <form id="form_add" method="POST" action="/contactos">
            @csrf
            <div class="lg:grid ld:grid-cols-3 md:grid md:grid-cols-2 sm:flex sm:flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <x-jet-label for="c_name_add" value="{{ __('Nombres y Apellidos') }}" class="mt-2" />
                    <x-jet-input id="c_name_add" class="block mt-2 w-full" type="text" name="name" value=""
                        required />
                </div>
                <div class="w-full px-3">
                    <x-jet-label for="c_cliente_id_add" value="{{ __('Cliente') }}" class="mt-2" />
                    <select required id="c_cliente_id_add" name="cliente_id" type="text"
                        class="form-select appearance-none block w-full mt-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option disabled selected>Seleccione un cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full px-3">
                    <x-jet-label for="c_phone_add" value="{{ __('Fono') }}" class="mt-2" />
                    <x-jet-input id="c_phone_add" class="block mt-2 w-full" type="number" name="phone"
                        placeholder="Fono" />
                </div>
                <div class="w-full px-3">
                    <x-jet-label for="c_email_add" value="{{ __('Correo') }}" class="mt-2" />
                    <x-jet-input id="c_email_add" class="block mt-2 w-full" type="text" name="email"
                        placeholder="Correo" required />
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
<x-edit-modal name="contactos-edit">
    <x-slot name="title" id="titulo_edit">
    </x-slot>
    <x-slot name="body">
        <div class="mt-5 mb-10">
            <div class="text-center font-serif text-3xl underline underline-offset-4">-- Editando al Contacto ✏ --
            </div>
        </div>
        <form method="POST" action="/contactos/" id="form_edit">
            @csrf
            {{ method_field('PUT') }}
            <div class="lg:grid ld:grid-cols-3 md:grid md:grid-cols-2 sm:flex sm:flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="c_name_edit" value="{{ __('Nombres Apellidos') }}" class="mt-2" />
                    <x-jet-input id="c_name_edit" class="block mt-2 w-full" type="text" name="name" value=""
                        required />
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="c_cliente_id_edit" value="{{ __('Cliente') }}" class="mt-2" />
                    <select required id="c_cliente_id_edit" name="cliente_id"
                        class="form-select appearance-none block w-full mt-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        aria-label="Seleccione el Cliente...">
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" @selected(old('c_cliente_id_edit') == $cliente->id)>
                                {{ $cliente->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="c_phone_edit" value="{{ __('Fono') }}" class="mt-2" />
                    <x-jet-input id="c_phone_edit" class="block mt-2 w-full" type="number" name="phone"
                        placeholder="Fono" />
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="c_email_edit" value="{{ __('Correo') }}" class="mt-2" />
                    <x-jet-input id="c_email_edit" class="block mt-2 w-full" type="text" name="email"
                        placeholder="Correo" required />
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
<x-delete-modal name="contactos-delete">
    <x-slot name="title">
        Eliminando al Contacto
    </x-slot>
    <x-slot name="body">
        <h1>¿Seguro desea eliminar al contacto?</h1>
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
<x-show-modal name="contactos-show">
    <x-slot name="title" id="titulo_show">
    </x-slot>
    <x-slot name="body">
        <div class="mt-5 mb-10">
            <div class="text-center font-serif text-3xl underline underline-offset-4">-- Detalles del Contacto 👁‍🗨 --
            </div>
        </div>
        <div class="lg:grid ld:grid-cols-3 md:grid md:grid-cols-2 sm:flex sm:flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="c_name_show" value="{{ __('Nombre y Apellidos') }}" class="mt-2" />
                <x-jet-input id="c_name_show" class="block mt-2 w-full" type="text" name="name"
                    value="" readonly placeholder="Nombre y Apellidos" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="c_cliente_id_show" value="{{ __('Cliente') }}" class="mt-2" />
                <select readonly id="c_cliente_id_show" name="cliente_id"
                    class="form-select appearance-none block w-full mt-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" @selected(old('c_cliente_id_show') == $cliente->id)>
                            {{ $cliente->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="c_phone_show" value="{{ __('Fono') }}" class="mt-2" />
                <x-jet-input readonly id="c_phone_show" class="block mt-2 w-full" type="number" name="phone"
                    placeholder="Fono" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="c_email_show" value="{{ __('Correo Electrónico') }}" class="mt-2" />
                <x-jet-input readonly id="c_email_show" class="block mt-2 w-full" type="text" name="email"
                    placeholder="Correo Electrónico" />
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
            ajax: '/getContactos',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name1',
                    name: 'name1'
                },
                {
                    data: 'name2',
                    name: 'name2'
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
        $('#contactos-add-modal').toggle();
    }

    function editarModal(id) {
        $('#contactos-edit').toggle();
        $('#titulo_edit').text('Editando al contacto ' + id);
        $('#form_edit').attr('action', "/contactos/" + id);
        $.ajax({
            url: "/getContacto/" + id,
            success: function(result) {
                $("#c_name_edit").attr("value", result.name);
                $('#c_cliente_id_edit').find('option[value="' + result.id + '"]').prop('selected', true);
                $("#c_phone_edit").attr("value", result.phone);
                $("#c_email_edit").attr("value", result.email);
            }
        });
    }

    function eliminarModal(id) {
        $("#contactos-delete").toggle();
        $("#form_delete").attr("action", "/contactos/" + id);
    }

    function detalleModal(id) {
        $("#contactos-show").toggle();
        $('#titulo_show').text('Detalles del contacto ID ' + id);
        $.ajax({
            url: "/getContacto/" + id,
            success: function(result) {

                $("#c_name_show").attr("value", result.name);
                $('#c_cliente_id_show').find('option[value="' + result.id + '"]').prop('selected', true);
                $("#c_phone_show").attr("value", result.phone);
                $("#c_email_show").attr("value", result.email);
            }
        });
    }
</script>
