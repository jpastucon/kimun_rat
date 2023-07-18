<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-500 uppercase tracking-wider leading-tight">
            {{ __('Administración de Marcas') }}
        </h2>
    </x-slot>
    <div>
        <div class="shadow-lg">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                    <div class="px-2 py-2 shadow overflow-x-auto border-b border-gray-200 sm:rounded-lg ">
                        <div class="py-2 px-2 text-center">
                            <div class="align-middle inline-block min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                                <button type="button" onclick="window.location='{{ route('modelos') }}'"
                                    class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    &nbsp⏏&nbspModelos&nbsp&nbsp</button>
                                <button type="button" onclick="agregarModal()"
                                    class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    &nbsp✚&nbspNueva Marca&nbsp&nbsp</button>
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
                                        Marca
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
<x-add-modal name="marca-add-modal">
    <x-slot name="title">
    </x-slot>
    <x-slot name="body">
        <div class="mt-5 mb-10 text-left">
            <div class="font-serif text-3xl underline underline-offset-4">-- Nueva Marca --
            </div>
        </div>
        <form id="form_add" method="POST" action="/marcas">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 pt-2 md:mb-0">
                    <x-jet-label for="m_name_add" value="{{ __('Nombre de la marca') }}" />
                    <x-jet-input id="m_name_add" class="block mt-1 w-full" type="text" name="name" value=""
                        required />
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 pt-2 md:mb-0">
                    <div id="m_tipo_maquinas_id_add">
                        <x-jet-label for="select" value="{{ __('Tipo/s de Maquinas asociadas') }}"
                            class="text-base font-bold mt-2" />
                        @livewire('multiselect-tipos-maquinas')
                    </div>
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
<x-edit-modal name="marca-edit">
    <x-slot name="title" id="titulo_edit">
        Editando Marca ✏
    </x-slot>
    <x-slot name="body">
        <form method="POST" action="/marcas/" id="form_edit">
            @csrf
            {{ method_field('PUT') }}
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 pt-2 md:mb-0">
                    <x-jet-label for="m_name_edit" value="{{ __('Nombre') }}" />
                    <x-jet-input id="m_name_edit" class="block mt-1 w-full" type="text" name="name" value=""
                        required />
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
<x-delete-modal name="marca-delete">
    <x-slot name="title">
        Eliminando la Marca
    </x-slot>
    <x-slot name="body">
        <h1>¿Seguro desea eliminar la Marca?</h1>
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
<x-show-modal name="marca-show">
    <x-slot name="title" id="titulo_show">
        Detalles de la Marca 👁‍🗨
    </x-slot>
    <x-slot name="body">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 pt-2 md:mb-0">
                <x-jet-label for="m_name_show" value="{{ __('Nombre') }}" />
                <x-jet-input id="m_name_show" class="block mt-1 w-full" type="text" name="name" value=""
                    required readonly />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 pt-2 md:mb-0">
                <x-jet-label for="m_created_at_show" value="{{ __('Fecha de creación') }}" />
                <x-jet-input id="m_created_at_show" class="block mt-1 w-full" type="text" name="created_at"
                    value="" required readonly />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="m_updated_at_show" value="{{ __('Fecha ult. actualización') }}" class="mt-2" />
                <x-jet-input id="m_updated_at_show" class="block mt-2 w-full" type="text" name="updated_at"
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
            ajax: '/getMarcas',
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
        $('#marca-add-modal').toggle();
    }

    function editarModal(id) {
        $('#marca-edit').toggle();
        $('#titulo_edit').text('Editando al marca ' + id);
        $('#form_edit').attr('action', "/marcas/" + id);
        $.ajax({
            url: "/getMarca/" + id,
            success: function(result) {
                $("#m_name_edit").attr("value", result.name);
                $('#m_tipo_maquinas_id_edit').find('option[value="' + result.tipo_maquinas_id + '"]').prop('selected', true);
                $("#m_created_at_edit").attr("value", result.created_at);
                $("#m_updated_at_edit").attr("value", result.updated_at);
            }
        });
    }

    function eliminarModal(id) {
        $("#marca-delete").toggle();
        $("#form_delete").attr("action", "/marcas/" + id);
    }

    function detalleModal(id) {
        $("#marca-show").toggle();
        $('#titulo_show').text('Detalles de la marca ID ' + id);
        $.ajax({
            url: "/getMarca/" + id,
            success: function(result) {
                $("#m_name_show").attr("value", result.name);
                $('#m_tipo_maquinas_id_show').find('option[value="' + result.tipo_maquinas_id + '"]').prop('selected', true);
                $("#m_created_at_show").attr("value", result.created_at);
                $("#m_updated_at_show").attr("value", result.updated_at);
            }
        });
    }

    function dropdownBis(init_values = []) {
        return {
            options: [],
            selected: [],
            show: false,
            open() {
                this.show = true
            },
            close() {
                this.show = false
            },
            isOpen() {
                return this.show === true
            },
            selectBis(index, event) {
                if (!this.options[index].selected) {
                    this.options[index].selected = true;
                    this.options[index].element = event.target;
                    this.selected.push(index);
                }
            },
            removeBis(index, option) {
                this.options[option].selected = false;
                this.selected.splice(index, 1);
            },
            loadOptionsBis() {
                const options = document.getElementById('select').options;
                for (let i = 0; i < options.length; i++) {
                    this.options.push({
                        value: options[i].value,
                        text: options[i].innerText,
                        selected: options[i].getAttribute('selected') != null ? options[i].getAttribute(
                            'selected') : false
                    });
                }
                for (let i = 0; i < this.options.length; i++) {
                    if (init_values.includes(this.options[i].text)) {
                        this.options[i].selected = true;
                        this.options[i].element = event.target;
                        this.selected.push(i);
                    }
                }
            },
            selectedValuesBis() {
                return this.selected.map((option) => {
                    return this.options[option].value;
                })
            }
        }
    }
</script>
