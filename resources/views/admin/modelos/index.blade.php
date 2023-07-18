<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-500 uppercase tracking-wider leading-tight">
            {{ __('Administración de Modelos') }}
        </h2>
    </x-slot>
    <div>
        <div class="shadow-lg">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                    <div class="px-2 py-2 shadow overflow-x-auto border-b border-gray-200 sm:rounded-lg ">
                        <div class="py-2 px-2 text-center">
                            <div class="align-middle inline-block min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                                <button type="button" onclick="window.location='{{ route('marcas') }}'"
                                    class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    &nbsp⏏&nbspMarcas&nbsp&nbsp</button>
                                <button type="button" onclick="agregarModal()"
                                    class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    &nbsp✚&nbspNuevo Modelo&nbsp&nbsp</button>
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
                                        Tipo Maquina
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Marca
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Nombre Modelo
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
<x-add-modal name="modelos-add-modal">
    <x-slot name="title">
    </x-slot>
    <x-slot name="body">
        <div class="mt-5 mb-10 text-left">
            <div class="font-serif text-3xl underline underline-offset-4">-- Nuevo Modelo --
            </div>
        </div>
        <form id="form_add" method="POST" action="/modelos">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="m_name_add" value="{{ __('Nombre') }}" class="mt-2" />
                    <x-jet-input id="m_name_add" class="block mt-2 w-full" type="text" name="name" value=""
                        required />
                </div>
                <div class="w-full md:w-1/2 px-3">
                    @livewire('select-anidado-tipo-marca')
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
<x-edit-modal name="modelos-edit">
    <x-slot name="title" id="titulo_edit">
        Editando Modelo ✏
    </x-slot>
    <x-slot name="body">
        <form method="POST" action="/modelos/" id="form_edit">
            @csrf
            {{ method_field('PUT') }}
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="m_name_edit" value="{{ __('Nombre') }}" class="mt-2" />
                    <x-jet-input id="m_name_edit" class="block mt-2 w-full" type="text" name="name" value=""
                        required />
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="m_tipo_maquina_id_edit" value="{{ __('Tipo de Maquina') }}" class="mt-2" />
                    <select id="m_tipo_maquina_id_edit" name="tipo_maquina_id" type="text"
                        class="form-select appearance-none block w-full mt-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option disabled selected>Seleccione el tipo de maquina</option>
                        @foreach ($tipo_maquinas as $tipo_maquina)
                            <option value="{{ $tipo_maquina->id }}">{{ $tipo_maquina->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="m_marca_id_edit" value="{{ __('Marca') }}" class="mt-2" />
                    <select id="m_marca_id_edit" name="marca_id"
                        class="form-select appearance-none block w-full mt-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}" @selected(old('marca_id') == $marca->id)>
                                {{ $marca->name }}
                            </option>
                        @endforeach
                    </select>
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
<x-delete-modal name="modelos-delete">
    <x-slot name="title">
        Eliminando al Modelo
    </x-slot>
    <x-slot name="body">
        <h1>¿Seguro desea eliminar al modelo?</h1>
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
<x-show-modal name="modelos-show">
    <x-slot name="title" id="titulo_show">
        Detalles del Modelo 👁‍🗨
    </x-slot>
    <x-slot name="body">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="m_name_show" value="{{ __('Nombre') }}" class="mt-2" />
                <x-jet-input id="m_name_show" class="block mt-2 w-full" type="text" name="name" value=""
                    readonly />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="m_tipo_maquina_id_show" value="{{ __('Tipo de Maquina') }}" class="mt-2" />
                <select id="m_tipo_maquina_id_show" name="tipo_maquina_id" type="text"
                    class="form-select appearance-none block w-full mt-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    <option disabled selected>Seleccione el tipo de maquina</option>
                    @foreach ($tipo_maquinas as $tipo_maquina)
                        <option value="{{ $tipo_maquina->id }}">{{ $tipo_maquina->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="m_marca_id_show" value="{{ __('Marca') }}" class="mt-2" />
                <select id="m_marca_id_show" name="marca_id"
                    class="form-select appearance-none block w-full mt-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}" @selected(old('m_marca_id_show') == $marca->id)>
                            {{ $marca->name }}
                        </option>
                    @endforeach
                </select>
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
            ajax: '/getModelos',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
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
        $('#modelos-add-modal').toggle();
    }

    function editarModal(id) {
        $('#modelos-edit').toggle();
        $('#titulo_edit').text('Editando al modelo ' + id);
        $('#form_edit').attr('action', "/modelos/" + id);
        $.ajax({
            url: "/getModelo/" + id,
            success: function(result) {
                $("#m_name_edit").attr("value", result.name);
                $('#m_tipo_maquina_id_edit').find('option[value="' + result.id1 + '"]').prop('selected', true);
                $('#m_marca_id_edit').find('option[value="' + result.id2 + '"]').prop('selected', true);
            }
        });
    }

    function eliminarModal(id) {
        $("#modelos-delete").toggle();
        $("#form_delete").attr("action", "/modelos/" + id);
    }

    function detalleModal(id) {
        $("#modelos-show").toggle();
        $('#titulo_show').text('Detalles del modelo ID ' + id);
        $.ajax({
            url: "/getModelo/" + id,
            success: function(result) {
                $("#m_name_show").attr("value", result.name);
                $('#m_tipo_maquina_id_show').find('option[value="' + result.id1 + '"]').prop('selected', true);
                $('#m_marca_id_show').find('option[value="' + result.id2 + '"]').prop('selected', true);
            }
        });
    }
</script>
