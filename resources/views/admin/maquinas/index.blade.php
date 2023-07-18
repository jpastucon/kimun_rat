<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-500 uppercase tracking-wider leading-tight">
            {{ __('Administración de Máquinas') }}
        </h2>
    </x-slot>
    <div>
        <div class="shadow-lg">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                    <div class="px-2 py-2 shadow overflow-x-auto border-b border-gray-200 sm:rounded-lg ">
                        <div class="grid sm:flex m-4 justify-center">
                            <button type="button" onclick="window.location='{{ route('marcas') }}'"
                                class="block m-1 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                &nbsp⏏&nbspMarcas&nbsp&nbsp</button>
                            <button type="button" onclick="window.location='{{ route('modelos') }}'"
                                class="block m-1 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                &nbsp⏏&nbspModelos&nbsp&nbsp</button>
                            <button type="button" onclick="window.location='{{ route('tipo_maquinas') }}'"
                                class="block m-1 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                &nbsp⏏&nbspTipo de Maquinas&nbsp&nbsp</button>
                            <button type="button" onclick="agregarModal()"
                                class="block m-1 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                &nbsp✚&nbspNueva Máquina&nbsp&nbsp</button>
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
                                        Tipo
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Marca
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Modelo
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
<x-add-modal name="maquinas-add-modal">
    <x-slot name="title">
    </x-slot>
    <x-slot name="body">
        <div class="mt-5 mb-10 text-center">
            <div class="font-serif text-3xl underline underline-offset-4">-- Nueva Maquina --
            </div>
        </div>
        <form id="form_add" method="POST" action="/maquinas">
            @csrf
            <div class="lg:grid ld:grid-cols-3 md:grid md:grid-cols-2 sm:flex sm:flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    @livewire('select-anidado')
                </div>
                <div class="w-full mt-2 px-3">
                    <x-jet-label for="m_name_add" value="{{ __('Nombre de la maquina') }}" class="mt-2" />
                    <x-jet-input id="m_name_add" class="block mt-2 w-full" type="text" name="name" value=""
                        required />
                </div>
                <div class="w-full mt-2 px-3">
                    <x-jet-label for="m_nro_serie_add" value="{{ __('N° de serie') }}" class="mt-2" />
                    <x-jet-input id="m_nro_serie_add" class="block mt-2 w-full" type="text" name="nro_serie"
                        value="" required />
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
<x-edit-modal name="maquinas-edit">
    <x-slot name="title" id="titulo_edit">

    </x-slot>
    <x-slot name="body">
        <div class="mt-5 mb-10 text-center">
            <div class="font-serif text-3xl underline underline-offset-4">-- Editando la Maquina ✏ --
            </div>
        </div>
        <form method="POST" action="/maquinas/" id="form_edit">
            @csrf
            {{ method_field('PUT') }}
            <div class="lg:grid ld:grid-cols-3 md:grid md:grid-cols-2 sm:flex sm:flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <x-jet-label for="m_tipo_maquina_id_edit" value="{{ __('Tipo Maquina') }}" class="mt-2" />
                    <select id="m_tipo_maquina_id_edit" name="tipo_maquinas_id" type="text"
                        class="form-select appearance-none block w-full mt-2 ">
                        <option disabled selected>Seleccione el tipo de maquina</option>
                        @foreach ($tipo_maquinas as $tipo_maquina)
                            <option value="{{ $tipo_maquina->id }}">{{ $tipo_maquina->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full mt-2 px-3">
                    <x-jet-label for="m_marca_id_edit" value="{{ __('Marca') }}" class="mt-2" />
                    <select id="m_marca_id_edit" name="marca_id" type="text"
                        class="form-select appearance-none block w-full mt-2 ">
                        <option disabled selected>Seleccione una marca</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full mt-2 px-3">
                    <x-jet-label for="m_modelo_id_edit" value="{{ __('Modelo') }}" class="mt-2" />
                    <select id="m_modelo_id_edit" name="modelo_id" type="text"
                        class="form-select appearance-none block w-full mt-2 ">
                        <option disabled selected>Seleccione un modelo</option>
                        @foreach ($modelos as $modelo)
                            <option value="{{ $modelo->id }}">{{ $modelo->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full mt-2 px-3">
                    <x-jet-label for="m_name_edit" value="{{ __('Nombre de la maquina') }}" class="mt-2" />
                    <x-jet-input id="m_name_edit" class="block mt-2 w-full" type="text" name="name"
                        value="" required />
                </div>
                <div class="w-full mt-2 px-3">
                    <x-jet-label for="m_nro_serie_edit" value="{{ __('N° de serie') }}" class="mt-2" />
                    <x-jet-input id="m_nro_serie_edit" class="block mt-2 w-full" type="text" name="nro_serie"
                        value="" required />
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
<x-delete-modal name="maquinas-delete">
    <x-slot name="title">
        Eliminando la Maquina
    </x-slot>
    <x-slot name="body">
        <h1>¿Seguro desea eliminar la maquina?</h1>
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
<x-show-modal name="maquinas-show">
    <x-slot name="title" id="titulo_show">
    </x-slot>
    <x-slot name="body">
        <div class="mt-5 mb-10 text-center">
            <div class="font-serif text-3xl underline underline-offset-4">-- Detalles de la Maquina 👁‍🗨 --
            </div>
        </div>
        <div class="lg:grid ld:grid-cols-3 md:grid md:grid-cols-2 sm:flex sm:flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-jet-label for="m_tipo_maquina_id_show" value="{{ __('Tipo Maquina') }}" class="mt-2" />
                <select readonly id="m_tipo_maquina_id_show" name="tipo_maquinas_id" type="text"
                    class="form-select appearance-none block w-full mt-2 ">
                    <option disabled selected>Seleccione el tipo de maquina</option>
                    @foreach ($tipo_maquinas as $tipo_maquina)
                        <option readonly value="{{ $tipo_maquina->id }}">{{ $tipo_maquina->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full mt-2 px-3">
                <x-jet-label for="m_marca_id_show" value="{{ __('Marca') }}" class="mt-2" />
                <select readonly id="m_marca_id_show" name="marca_id" type="text"
                    class="form-select appearance-none block w-full mt-2 ">
                    <option disabled selected>Seleccione una marca</option>
                    @foreach ($marcas as $marca)
                        <option readonly value="{{ $marca->id }}">{{ $marca->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full mt-2 px-3">
                <x-jet-label for="m_modelo_id_show" value="{{ __('Modelo') }}" class="mt-2" />
                <select readonly id="m_modelo_id_show" name="modelo_id" type="text"
                    class="form-select appearance-none block w-full mt-2 ">
                    <option disabled selected>Seleccione un modelo</option>
                    @foreach ($modelos as $modelo)
                        <option readonly value="{{ $modelo->id }}">{{ $modelo->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full mt-2 px-3">
                <x-jet-label for="m_name_show" value="{{ __('Nombre de la maquina') }}" class="mt-2" />
                <x-jet-input id="m_name_show" class="block mt-2 w-full" type="text" name="name"
                    value="" required readonly />
            </div>
            <div class="w-full mt-2 px-3">
                <x-jet-label for="m_nro_serie_show" value="{{ __('N° de serie') }}" class="mt-2" />
                <x-jet-input id="m_nro_serie_show" class="block mt-2 w-full" type="text" name="nro_serie"
                    value="" required readonly />
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
            ajax: '/getMaquinas',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name3',
                    name: 'name3'
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
                [1, 'asc']
            ],
            pageLength: 25,
        });
    });

    function agregarModal() {
        $('#maquinas-add-modal').toggle();
    }

    function editarModal(id) {
        $('#maquinas-edit').toggle();
        $('#titulo_edit').text('Editando al maquina ' + id);
        $('#form_edit').attr('action', "/maquinas/" + id);
        $.ajax({
            url: "/getMaquina/" + id,
            success: function(result) {
                $("#m_name_edit").attr("value", result.name);
                $('#m_marca_id_edit').find('option[value="' + result.id + '"]').prop('selected', true);
                $('#m_modelo_id_edit').find('option[value="' + result.id + '"]').prop('selected', true);
                $('#m_tipo_maquina_id_edit').find('option[value="' + result.id + '"]').prop('selected',
                    true);
                $("#m_nro_serie_edit").attr("value", result.nro_serie);
            }
        });
    }

    function eliminarModal(id) {
        $("#maquinas-delete").toggle();
        $("#form_delete").attr("action", "/maquinas/" + id);
    }

    function detalleModal(id) {
        $("#maquinas-show").toggle();
        $('#titulo_show').text('Detalles de la Maquina ID ' + id);
        $.ajax({
            url: "/getMaquina/" + id,
            success: function(result) {
                $("#m_name_show").attr("value", result.name);
                $('#m_marca_id_show').find('option[value="' + result.id + '"]').prop('selected', true);
                $('#m_modelo_id_show').find('option[value="' + result.id + '"]').prop('selected', true);
                $('#m_tipo_maquina_id_show').find('option[value="' + result.id + '"]').prop('selected',
                    true);
                $("#m_nro_serie_show").attr("value", result.nro_serie);
            }
        });
    }

    function getMarcas() {
        return document.getElementById('m_tipo_maquina_id_add').value;
    }
</script>
