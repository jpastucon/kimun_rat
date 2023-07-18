<x-app-module-rat-layout>

    <head>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/js/jquery.signature.js"></script>
        <script type="text/javascript" src="/js/jquery.ui.touch-punch.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/jquery.signature.css">
        <link type="text/css"
            href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
            rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css/images_upload.css">
        <script type="text/javascript" src="/js/images_upload.js"></script>

        <style>
            .kbw-signature {
                width: 100%;
                height: 250px;
            }
        </style>

    </head>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-500 uppercase tracking-wider leading-tight">
            @if (Auth::user()->rol_id == 1)
                {{ __('Administración Registros de Atención Técnica') }}
            @elseif(Auth::user()->rol_id == 2)
                {{ __('Panel de tus Registros de Atención Técnica') }}
            @endif
        </h2>
    </x-slot>
    <div>
        <div class="shadow-lg">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                    <div class="px-2 py-2 shadow overflow-x-auto border-b border-gray-200 sm:rounded-lg ">
                        <div class="grid sm:flex m-4 justify-center">
                            <button type="button" onclick="window.location='{{ route('estados') }}'"
                                class="block m-1 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                &nbsp⏏&nbspAdministrar Estados&nbsp&nbsp</button>
                            <button type="button" onclick="agregarModal()"
                                class="block m-1 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                &nbsp✚&nbspNuevo RAT&nbsp&nbsp</button>
                        </div>
                        <table id="dataTable" class="min-w-full divide-x divide-y divide-gray-200 stripe row-border">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="all px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="all px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        RAT
                                    </th>
                                    <th scope="col"
                                        class="none px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cliente
                                    </th>
                                    <th scope="col"
                                        class="all px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th scope="col"
                                        class="none px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        # Maquinas
                                    </th>
                                    <th scope="col"
                                        class="none px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Ingresado por
                                    </th>
                                    <th scope="col"
                                        class="all text-left text-xs font-medium uppercase tracking-wider">

                                    </th>
                                    <th scope="col"
                                        class="all text-left text-xs font-medium uppercase tracking-wider">

                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-module-rat-layout>

<!--Agregar-->
<x-add-modal name="rats-add-modal">
    <x-slot name="title">
    </x-slot>
    <x-slot name="body">
        <form id="form_add" name="form_add" method="POST" action="/rats" enctype="multipart/form-data">
            @csrf
            <div class="lg:ml-20 lg:mr-20">
                <div class="mt-5 mb-10 text-center">
                    <div class="font-serif text-3xl underline underline-offset-4">Reporte de Asistencia Técnica
                    </div>
                </div>
                <div class="flex -mx-3 mb-6">
                    <!--RatID, UserID & RatName -->
                    <x-jet-input class="hidden" id="id" name="id" value="{{ $contador + 1 }}" readonly />
                    <div class="w-36 md:w-1/2 px-3">
                        <x-jet-label for="r_user_id_add" value="{{ __('User ID') }}" class="text-base font-bold mt-2" />
                        <x-jet-input id="r_user_id_add" name="user_id"
                            class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                            type="text" value="{{ Auth::user()->id }}" required readonly />
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <x-jet-label for="rat_name_add" value="{{ __('Título del Registro') }}"
                            class="text-base font-bold mt-2" />
                        <x-jet-input id="rat_name_add" name="name"
                            class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                            type="text"
                            value="RAT-{{ substr(Auth::user()->name, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}-{{ $contador + 1 }}"
                            required readonly />
                    </div>
                </div>
                <div class="flex -mx-3 mb-6">
                    <!--ContactoID-->
                    <div class="w-full md:w-1/2 px-3">
                        <x-jet-label for="r_contacto_id_add" value="{{ __('Contacto') }}"
                            class="text-base font-bold mt-2" />
                        <select id="r_contacto_id_add" name="contacto_id" type="text"
                            class="form-select appearance-none block w-full mt-2 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option disabled selected>Seleccione un Contacto</option>
                            @foreach ($contactos as $contacto)
                                <option value="{{ $contacto->id }}">{{ $contacto->name }} -
                                    {{ $contacto->namecliente }}</option>
                            @endforeach
                        </select>
                        <div
                            class="w-full pt-2 select-none border-l-4 border-blue-400 bg-blue-100 p-4 font-medium hover:border-blue-500">
                            Si no se encuentra en el listado se debe agregar un
                            <a href="{{ route('contactos') }}" target="_blank"><strong>nuevo contacto</strong></a>
                        </div>
                    </div>
                    <!--Tipo Rat-->
                    <div class="w-full md:w-1/2 px-3">
                        <x-jet-label for="r_tipo_rat_add" value="{{ __('Tipo de RAT') }}"
                            class="text-base font-bold mt-2" />
                        <select id="r_tipo_rat_add" name="tipo_rat" type="text"
                            class="form-select appearance-none block w-full mt-2 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option disabled selected>Selecciona un tipo de registro</option>
                            <option value="Correctivo">Correctivo</option>
                            <option value="Preventivo">Preventivo</option>
                            <option value="Instalación">Instalación</option>
                            <option value="Capacitación">Capacitación</option>
                            <option value="Cotizado">Cotizado</option>
                            <option value="Inspección">Inspección</option>
                        </select>
                    </div>
                </div>
                <div class="flex -mx-3 mb-6">
                    <!--Fecha-->
                    <div class="w-full sm:w-1/2 px-3">
                        <x-jet-label for="r_fecha_add" value="{{ __('Fecha Inicial del RAT') }}"
                            class="text-base font-bold mt-2" />
                        <x-jet-input id="r_fecha_add" name="fecha"
                            class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                            type="date" />
                    </div>
                </div>
                <!--Horarios-->
                <div id="r_horarios_add" class="mt-4 mb-4">
                    <div class="grid md:grid-cols-6 sm:grid-cols-2">
                        <div class="text-center md:w-full sm:w-3/4 px-1">
                            <x-jet-label for="r_hora_ini_traslado_add" value="{{ __('Hora INI Traslado') }}"
                                class="mt-2" />
                            <input type="time"
                                class="w-full pl-2 pr-2 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                id="r_hora_ini_traslado_add" name="hora_ini_traslado">
                        </div>
                        <div class="text-center md:w-full sm:w-3/4 px-1">
                            <x-jet-label for="r_hora_fin_traslado_add" value="{{ __('Hora FIN Traslado') }}"
                                class="mt-2" />
                            <input type="time"
                                class="w-full pl-2 pr-2 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                id="r_hora_fin_traslado_add" name="hora_fin_traslado">
                        </div>
                        <div class="text-center md:w-full sm:w-3/4 px-1">
                            <x-jet-label for="r_hora_ini_traslado_add" value="{{ __('Hora INI Trabajo') }}"
                                class="mt-2" />
                            <input type="time"
                                class="w-full pl-2 pr-2 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                id="r_hora_ini_trabajo_add" name="hora_ini_trabajo">
                        </div>
                        <div class="text-center md:w-full sm:w-3/4 px-1">
                            <x-jet-label for="r_hora_fin_trabajo_add" value="{{ __('Hora FIN Trabajo') }}"
                                class="mt-2" />
                            <input type="time"
                                class="w-full pl-2 pr-2 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                id="r_hora_fin_trabajo_add" name="hora_fin_trabajo">
                        </div>
                        <div class="text-center md:w-full sm:w-3/4 px-1">
                            <x-jet-label for="r_hora_ini_traslado_add" value="{{ __('Hora INI salida') }}"
                                class="mt-2" />
                            <input type="time"
                                class="w-full pl-2 pr-2 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                id="r_hora_ini_salida_add" name="hora_ini_salida">
                        </div>
                        <div class="text-center md:w-full sm:w-3/4 px-1">
                            <x-jet-label for="r_hora_fin_salida_add" value="{{ __('Hora FIN salida') }}"
                                class="mt-2" />
                            <input type="time"
                                class="w-full pl-2 pr-2 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                id="r_hora_fin_salida_add" name="hora_fin_salida">
                        </div>
                    </div>
                </div>
                <div class="flex -mx-3 mb-6">
                    <!--Maquinas-->
                    <div class="w-full lg:w-full md:w-1/2 px-3">
                        <div id="r_maquinas_add">
                            <x-jet-label for="select" value="{{ __('Maquinas Asociadas') }}"
                                class="text-base font-bold mt-2" />
                            @livewire('multiselect-maquinas')
                        </div>
                    </div>
                </div>
                <div class="flex -mx-3 mb-6">
                    <!--Fotos-->
                    <div class="w-full lg:w-full md:w-1/2 px-3">
                        <x-jet-label for="fotos" value="{{ __('Documentación, Fotos, Archivos.') }}"
                            class="text-base font-bold mt-2" />
                        <x-jet-input type="file" id="files" name="files[]" multiple
                            class="w-full form-control pt-4 block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" />
                    </div>
                </div>
                <div class="flex -mx-3 mb-6">
                    <!--Sintoma-->
                    <div class="w-full md:w-1/2 px-3">
                        <x-jet-label for="r_sintoma_id_add" value="{{ __('Sintoma') }}"
                            class="text-base font-bold mt-2" />
                        <textarea id="r_sintoma_id_add" name="sintoma"
                            class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            rows="3" placeholder="Escriba aquí el sintoma/análisis"></textarea>
                    </div>
                    <!--Desarrollo-->
                    <div class="w-full md:w-1/2 px-3">
                        <x-jet-label for="r_desarrollo_id_add" value="{{ __('Desarrollo') }}"
                            class="text-base font-bold mt-2" />
                        <textarea id="r_desarrollo_id_add" name="desarrollo"
                            class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            rows="3" placeholder="Escriba aquí el desarrollo"></textarea>
                    </div>
                </div>
                <div class="flex -mx-3 mb-6">
                    <!--Observaciones-->
                    <div class="w-full md:w-1/2 px-3">
                        <x-jet-label for="r_observaciones_id_add" value="{{ __('Observaciones') }}"
                            class="text-base font-bold mt-2" />
                        <textarea id="r_observaciones_id_add" name="observaciones"
                            class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            rows="3" placeholder="Escriba aquí las observaciones"></textarea>
                    </div>
                    <!--Pendientes-->
                    <div class="w-full md:w-1/2 px-3">
                        <x-jet-label for="r_pendientes_id_add" value="{{ __('Pendientes') }}"
                            class="text-base font-bold mt-2" />
                        <textarea id="r_pendientes_id_add" name="pendientes"
                            class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            rows="3" placeholder="Escriba aquí las tareas pendientes"></textarea>
                    </div>
                </div>
            </div>
    </x-slot>
    <x-slot name="footer">
        <x-button id="btn_add"
            class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Validar y Guardar</x-button>
        </form>
    </x-slot>

</x-add-modal>

<!--Agregar Información-->
<x-add-fecha-rat-modal name="rats-fecha-add-modal">
    <x-slot name="title">
    </x-slot>
    <x-slot name="body">
        <form id="form_add" name="form_add" method="POST" action="/rats_fecha" enctype="multipart/form-data">
            @csrf
            <div class="lg:ml-20 lg:mr-20">
                <!--Detalles RAT -->
                <div id="modal_rats_fecha">
                    <div class="mt-5 text-center">
                        <div class="font-serif text-3xl underline underline-offset-4">
                            Reporte de Asistencia Técnica
                        </div>
                    </div>
                    <div class="mt-5 mr-10 grid justify-end text-center">
                        <div class="h-10 w-60 rounded-md border-2 border-solid border-black pt-1">
                            <strong class="m-2" id="modal_rats_fecha_rat_name"></strong>
                            <x-jet-input id="modal_rats_fecha_rat_name_input" name="rat_name" value=""
                                hidden />
                        </div>
                    </div>

                    <div class="flex-row">
                        <div class="flex border border-current mt-8">
                            <strong class="pl-2">Fechas: |</strong>
                            <div id="modal_rats_fecha_fechas" class="pl-1">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-4 sm:grid-cols-2">
                            <div class="border border-current pl-2 pr-2 text-justify">
                                <strong>Cliente:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="modal_rats_fecha_cliente_name"></p>
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Contacto:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="modal_rats_fecha_contacto_name"></p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-4 sm:grid-cols-2">
                            <div class="border border-current pl-2 pr-2 text-justify"><strong>Fono:</strong></div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="modal_rats_fecha_contacto_phone"></p>
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Correo:</strong></div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="modal_rats_fecha_contacto_email"></p>
                            </div>
                        </div>

                        <div class="mt-6" id="modal_rats_fecha_maquinas">
                        </div>

                        <div class="mt-6" id="modal_rats_fecha_horarios">
                        </div>

                        <div class="flex mt-6">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Tipo de
                                    Trabajo:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="modal_rats_fecha_tipo"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Sintomas:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="modal_rats_fecha_sintoma"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Desarrollo:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="modal_rats_fecha_desarrollo"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify">
                                <strong>Observaciones:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="modal_rats_fecha_observaciones"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Pendientes:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="modal_rats_fecha_pendientes"></p>
                            </div>
                        </div>

                        <div id="modal_rats_fecha_fotos"
                            class="md:flex sm:grid text-center px-2 py-2 mt-6 mb-5 w-full border border-current">
                        </div>

                    </div>
                </div>
                <!-- Información Adicional -->
                <div id="modal_rats_fecha_add" class="lg:ml-20 lg:mr-20">
                    <div class="mt-5 mb-10 text-center">
                        <div class="font-serif text-3xl underline underline-offset-4">Información adicional</div>
                    </div>
                    <!--Fecha-->
                    <div class="flex -mx-3 mb-6">
                        <div class="w-full sm:w-1/2 px-3 text-center">
                            <x-jet-label for="modal_rats_fecha_fecha_add" value="{{ __('Fecha') }}"
                                class="text-base font-bold mt-2" />
                            <x-jet-input id="modal_rats_fecha_fecha_add" name="fecha_add"
                                class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                type="date" />
                        </div>
                    </div>
                    <!--Horarios-->
                    <div id="modal_rats_fecha_horarios_add" class="mt-4 mb-4">
                        <div class="grid md:grid-cols-6 sm:grid-cols-2">
                            <div class="text-center md:w-full sm:w-3/4 px-1">
                                <x-jet-label for="modal_rats_fecha_hora_ini_traslado_add"
                                    value="{{ __('Hora INI Traslado') }}" class="mt-2" />
                                <input type="time"
                                    class="w-full pl-2 pr-2 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                    id="modal_rats_fecha_hora_ini_traslado_add" name="hora_ini_traslado_add">
                            </div>
                            <div class="text-center md:w-full sm:w-3/4 px-1">
                                <x-jet-label for="modal_rats_fecha_hora_fin_traslado_add"
                                    value="{{ __('Hora FIN Traslado') }}" class="mt-2" />
                                <input type="time"
                                    class="w-full pl-2 pr-2 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                    id="modal_rats_fecha_hora_fin_traslado_add" name="hora_fin_traslado_add">
                            </div>
                            <div class="text-center md:w-full sm:w-3/4 px-1">
                                <x-jet-label for="modal_rats_fecha_hora_ini_trabajo_add"
                                    value="{{ __('Hora INI Trabajo') }}" class="mt-2" />
                                <input type="time"
                                    class="w-full pl-2 pr-2 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                    id="modal_rats_fecha_hora_ini_trabajo_add" name="hora_ini_trabajo_add">
                            </div>
                            <div class="text-center md:w-full sm:w-3/4 px-1">
                                <x-jet-label for="modal_rats_fecha_hora_fin_trabajo_add"
                                    value="{{ __('Hora FIN Trabajo') }}" class="mt-2" />
                                <input type="time"
                                    class="w-full pl-2 pr-2 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                    id="modal_rats_fecha_hora_fin_trabajo_add" name="hora_fin_trabajo_add">
                            </div>
                            <div class="text-center md:w-full sm:w-3/4 px-1">
                                <x-jet-label for="modal_rats_fecha_hora_ini_traslado_add"
                                    value="{{ __('Hora INI salida') }}" class="mt-2" />
                                <input type="time"
                                    class="w-full pl-2 pr-2 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                    id="modal_rats_fecha_hora_ini_salida_add" name="hora_ini_salida_add">
                            </div>
                            <div class="text-center md:w-full sm:w-3/4 px-1">
                                <x-jet-label for="modal_rats_fecha_hora_fin_salida_add"
                                    value="{{ __('Hora FIN salida') }}" class="mt-2" />
                                <input type="time"
                                    class="w-full pl-2 pr-2 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                    id="modal_rats_fecha_hora_fin_salida_add" name="hora_fin_salida_add">
                            </div>
                        </div>
                    </div>
                    <!-- Fotos -->
                    <div id="modal_rats_fecha_fotos_add">
                        <div class="flex -mx-3 mb-6">
                            <div class="w-full lg:w-full md:w-1/2 px-3">
                                <x-jet-label for="fotos" value="{{ __('Documentación, Fotos, Archivos.') }}"
                                    class="text-base font-bold mt-2" />
                                <x-jet-input type="file" id="files_add" name="files[]" multiple
                                    class="w-full form-control pt-4 block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" />
                            </div>
                        </div>
                    </div>
                    <!-- TextAreas -->
                    <div id="modal_rats_fecha_textareas_add">
                        <div class="flex -mx-3 mb-6">
                            <!--Sintoma-->
                            <div class="w-full md:w-1/2 px-3">
                                <x-jet-label for="modal_rats_fecha_sintoma_add" value="{{ __('Sintoma') }}"
                                    class="text-base font-bold mt-2" />
                                <textarea id="modal_rats_fecha_sintoma_add" name="sintoma_add"
                                    class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    rows="3" placeholder="Escriba aquí el sintoma/análisis"></textarea>
                            </div>
                            <!--Desarrollo-->
                            <div class="w-full md:w-1/2 px-3">
                                <x-jet-label for="modal_rats_fecha_desarrollo_add" value="{{ __('Desarrollo') }}"
                                    class="text-base font-bold mt-2" />
                                <textarea id="modal_rats_fecha_desarrollo_add" name="desarrollo_add"
                                    class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    rows="3" placeholder="Escriba aquí el desarrollo"></textarea>
                            </div>
                        </div>
                        <div class="flex -mx-3 mb-6">
                            <!--Observaciones-->
                            <div class="w-full md:w-1/2 px-3">
                                <x-jet-label for="modal_rats_fecha_observaciones_add"
                                    value="{{ __('Observaciones') }}" class="text-base font-bold mt-2" />
                                <textarea id="modal_rats_fecha_observaciones_add" name="observaciones_add"
                                    class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    rows="3" placeholder="Escriba aquí las observaciones"></textarea>
                            </div>
                            <!--Pendientes-->
                            <div class="w-full md:w-1/2 px-3">
                                <x-jet-label for="modal_rats_fecha_pendientes_add" value="{{ __('Pendientes') }}"
                                    class="text-base font-bold mt-2" />
                                <textarea id="modal_rats_fecha_pendientes_add" name="pendientes_add"
                                    class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    rows="3" placeholder="Escriba aquí las tareas pendientes"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </x-slot>
    <x-slot name="footer">
        <x-button id="btn_add"
            class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Validar y Guardar</x-button>
        </form>
    </x-slot>
</x-add-fecha-rat-modal>

<!--Editar-->
<x-edit-modal name="rats-edit">
    <x-slot name="title" id="titulo_edit">
    </x-slot>
    <x-slot name="body">
        <form method="POST" action="/rats/" id="form_edit">
            @csrf
            {{ method_field('PUT') }}
            <div class="lg:ml-20 lg:mr-20">
                <!--Detalles RAT -->
                <div id="modal_rats_fecha">
                    <div class="mt-5 text-center">
                        <div class="font-serif text-3xl underline underline-offset-4">
                            Reporte de Asistencia Técnica
                        </div>
                    </div>
                    <div class="mt-5 mr-10 grid justify-end text-center">
                        <div class="h-10 w-60 rounded-md border-2 border-solid border-black pt-1">
                            <strong class="m-2" id="modal_rats_edit_rat_name"></strong>
                            <x-jet-input id="modal_rats_edit_rat_name_input" name="rat_name" value="" hidden />
                        </div>
                    </div>

                    <div class="flex-row">
                        <div class="flex border border-current mt-8">
                            <strong class="pl-2">Fechas: |</strong>
                            <div id="modal_rats_edit_fechas" class="pl-1">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-4 sm:grid-cols-2">
                            <div class="border border-current pl-2 pr-2 text-justify">
                                <strong>Cliente:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="modal_rats_edit_cliente_name"></p>
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Contacto:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="modal_rats_edit_contacto_name"></p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-4 sm:grid-cols-2">
                            <div class="border border-current pl-2 pr-2 text-justify"><strong>Fono:</strong></div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="modal_rats_edit_contacto_phone"></p>
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Correo:</strong></div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="modal_rats_edit_contacto_email"></p>
                            </div>
                        </div>

                        <div class="mt-6" id="modal_rats_edit_maquinas">
                        </div>

                        <div class="mt-6" id="modal_rats_edit_horarios">
                        </div>

                        <div class="flex mt-6">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Tipo de
                                    Trabajo:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="modal_rats_edit_tipo"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Sintomas:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="modal_rats_edit_sintoma"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Desarrollo:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="modal_rats_edit_desarrollo"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify">
                                <strong>Observaciones:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="modal_rats_edit_observaciones"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Pendientes:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="modal_rats_edit_pendientes"></p>
                            </div>
                        </div>

                        <div id="modal_rats_edit_fotos"
                            class="md:flex sm:grid text-center px-2 py-2 mt-6 mb-5 w-full border border-current">
                        </div>

                    </div>
                </div>
                <!-- Información Adicional -->
                <div id="modal_rats_edit_add" class="lg:ml-20 lg:mr-20">
                    <div class="mt-5 mb-10 text-center">
                        <div class="font-serif text-3xl underline underline-offset-4">Edición de Información</div>
                    </div>
                    <!-- Fotos -->
                    <div id="modal_rats_edit_fotos_add">
                        <div class="flex -mx-3 mb-6">
                            <div class="w-full lg:w-full md:w-1/2 px-3">
                                <x-jet-label for="fotos"
                                    value="{{ __('Añadir Documentación, Fotos, Archivos.') }}"
                                    class="text-base font-bold mt-2" />
                                <x-jet-input type="file" id="files_add" name="files[]" multiple
                                    class="w-full form-control pt-4 block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" />
                            </div>
                        </div>
                    </div>
                    <!-- TextAreas -->
                    <div id="modal_rats_edit_textareas_add">
                        <div class="flex -mx-3 mb-6">
                            <!--Sintoma-->
                            <div class="w-full md:w-1/2 px-3">
                                <x-jet-label for="modal_rats_edit_sintoma_add" value="{{ __('Sintoma') }}"
                                    class="text-base font-bold mt-2" />
                                <textarea id="modal_rats_edit_sintoma_add" name="sintoma_add"
                                    class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    rows="3" placeholder="Escriba aquí el sintoma/análisis"></textarea>
                            </div>
                            <!--Desarrollo-->
                            <div class="w-full md:w-1/2 px-3">
                                <x-jet-label for="modal_rats_edit_desarrollo_add" value="{{ __('Desarrollo') }}"
                                    class="text-base font-bold mt-2" />
                                <textarea id="modal_rats_edit_desarrollo_add" name="desarrollo_add"
                                    class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    rows="3" placeholder="Escriba aquí el desarrollo"></textarea>
                            </div>
                        </div>
                        <div class="flex -mx-3 mb-6">
                            <!--Observaciones-->
                            <div class="w-full md:w-1/2 px-3">
                                <x-jet-label for="modal_rats_edit_observaciones_add"
                                    value="{{ __('Observaciones') }}" class="text-base font-bold mt-2" />
                                <textarea id="modal_rats_edit_observaciones_add" name="observaciones_add"
                                    class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    rows="3" placeholder="Escriba aquí las observaciones"></textarea>
                            </div>
                            <!--Pendientes-->
                            <div class="w-full md:w-1/2 px-3">
                                <x-jet-label for="modal_rats_edit_pendientes_add" value="{{ __('Pendientes') }}"
                                    class="text-base font-bold mt-2" />
                                <textarea id="modal_rats_edit_pendientes_add" name="pendientes_add"
                                    class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    rows="3" placeholder="Escriba aquí las tareas pendientes"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </x-slot>
    <x-slot name="footer">
        <x-button id="btn_add"
            class="block ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Validar y Guardar</x-button>
        </form>

    </x-slot>
</x-edit-modal>

<!--Eliminar-->
<x-delete-modal name="rats-delete">
    <x-slot name="title">
        ¡Cuidado!
    </x-slot>
    <x-slot name="body">
        <h1>¿Está seguro que desea eliminar el RAT?</h1>
    </x-slot>
    <x-slot name="footer">
        <form method="POST" action="javascript:void(0)" id="form_delete">
            @csrf
            {{ method_field('DELETE') }}
            <x-button type="submit"
                class="block mr-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Eliminar</x-button>
        </form>
    </x-slot>
</x-delete-modal>

<!--Añadir Firma-->
<x-add-rat-modal name="rats-show">
    <x-slot name="title">
        <div id="titulo_show">
        </div>
    </x-slot>
    <x-slot name="body">
        <form id="form_rats_valid" method="POST" action="/rat_valid">
            @csrf
            <!--Detalles RAT -->
            <div class="lg:ml-20 lg:mr-20">
                <div class="grid grid-cols-2 justify-center">
                    <div class="text-left">
                        <img src="{{ asset('/img/logo.jpg') }}" alt="..."
                            class="relative border-none p-2 align-middle" style="height: 140px" />
                    </div>
                    <div class="text-right">
                        <div style="color: rgb(53, 112, 155);" class="text-md">Mantención Desarrollo Ingeniería SpA
                        </div>
                        <div style="color: rgb(53, 112, 155);" class="text-md">RUT: 76.187.132 – 3</div>
                        <div style="color: rgb(53, 112, 155);" class="text-md">Dirección: Pasaje Los Fresnos # 431,
                            Villa
                            Padelpa, Mostazal</div>
                        <div style="color: rgb(53, 112, 155);" class="text-md">Fono: +56 9 3429 8279</div>
                        <div style="color: rgb(53, 112, 155);" class="text-md">Email: contacto@madein-eirl.cl</div>
                    </div>
                </div>
                <div id="rats_show_add">
                    <div class="mt-5 text-center">
                        <div class="font-serif text-3xl underline underline-offset-4">Reporte de Asistencia Técnica
                        </div>
                    </div>
                    <div class="mt-5 mr-10 grid justify-end text-center">
                        <div class="h-10 w-60 rounded-md border-2 border-solid border-black pt-1">
                            <strong class="m-2" id="show_rat_name"></strong>
                            <x-jet-input id="show_rat_id" name="show_rat_id" hidden />
                        </div>
                    </div>

                    <div class="flex-row">
                        <div class="flex border border-current mt-8">
                            <strong class="pl-2">Fechas: |</strong>
                            <div id="show_rat_fecha" class="pl-1">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-4 sm:grid-cols-2">
                            <div class="border border-current pl-2 pr-2 text-justify">
                                <strong>Cliente:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="show_cliente_name"></p>
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Contacto:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="show_contacto_name"></p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-4 sm:grid-cols-2">
                            <div class="border border-current pl-2 pr-2 text-justify"><strong>Fono:</strong></div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="show_contacto_phone"></p>
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Correo:</strong></div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="show_contacto_email"></p>
                            </div>
                        </div>

                        <div class="mt-6" id="show_maquinas">
                        </div>

                        <div class="mt-6" id="show_horarios">
                        </div>

                        <div class="flex mt-6">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Tipo de
                                    Trabajo:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="show_rat_tipo"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Sintoma:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="show_rat_sintoma"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Desarrollo:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="show_rat_desarrollo"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify">
                                <strong>Observaciones:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="show_rat_observaciones"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Pendientes:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="show_rat_pendientes"></p>
                            </div>
                        </div>

                        <div id="show_fotos" class="flex sm:grid px-2 py-2 mt-6 mb-5 w-full border border-current">
                        </div>

                    </div>
                </div>
                <!--FIRMA-->
                <div class="text-center mt-6 mb-2">
                    <label><strong>Ingrese la firma de <p id="show1_contacto_name"></p></strong></label>
                    <br />
                    <div id="sig"></div>
                    <br />
                    <button id="clear"
                        class="m-4 rounded bg-red-500 py-2 px-4 font-bold text-white">Limpiar</button>

                    <textarea id="signature64" name="signed" style="display: none"></textarea>
                </div>
            </div>
    </x-slot>
    <x-slot name="footer">
        <x-button id="btn_add"
            class="block mr-6 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Guardar Firma</x-button>
        </form>
    </x-slot>
</x-add-rat-modal>

<!--Envío de Correo-->
<x-add-rat-modal1 name="rats-show1">
    <x-slot name="title">
        <div id="titulo_show">
        </div>
    </x-slot>
    <x-slot name="body">
        <form id="form_rats_valid" method="POST" action="/rat_send_mail">
            @csrf
            <!--Detalles RAT -->
            <div class="lg:ml-20 lg:mr-20">
                <div class="grid grid-cols-2 justify-center">
                    <div class="text-left">
                        <img src="{{ asset('/img/logo.jpg') }}" alt="..."
                            class="relative border-none p-2 align-middle" style="height: 140px" />
                    </div>
                    <div class="text-right">
                        <div style="color: rgb(53, 112, 155);" class="text-md">Mantención Desarrollo Ingeniería SpA
                        </div>
                        <div style="color: rgb(53, 112, 155);" class="text-md">RUT: 76.187.132 – 3</div>
                        <div style="color: rgb(53, 112, 155);" class="text-md">Dirección: Pasaje Los Fresnos # 431,
                            Villa
                            Padelpa, Mostazal</div>
                        <div style="color: rgb(53, 112, 155);" class="text-md">Fono: +56 9 3429 8279</div>
                        <div style="color: rgb(53, 112, 155);" class="text-md">Email: contacto@madein-eirl.cl</div>
                    </div>
                </div>
                <div id="rats_show_out_add">
                    <div class="mt-5 text-center">
                        <div class="font-serif text-3xl underline underline-offset-4">Reporte de Asistencia Técnica
                        </div>
                    </div>
                    <div class="mt-5 mr-10 grid justify-end text-center">
                        <div class="h-10 w-60 rounded-md border-2 border-solid border-black pt-1">
                            <strong class="m-2" id="show_out_rat_name"></strong>
                            <x-jet-input id="show_out_rat_id" name="show_out_rat_id" hidden />
                        </div>
                    </div>

                    <div class="flex-row">
                        <div class="flex border border-current mt-8">
                            <strong class="pl-2">Fechas: |</strong>
                            <div id="show_out_rat_fecha" class="pl-1">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-4 sm:grid-cols-2">
                            <div class="border border-current pl-2 pr-2 text-justify">
                                <strong>Cliente:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="show_out_cliente_name"></p>
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Contacto:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="show_out_contacto_name"></p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-4 sm:grid-cols-2">
                            <div class="border border-current pl-2 pr-2 text-justify"><strong>Fono:</strong></div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="show_out_contacto_phone"></p>
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Correo:</strong></div>
                            <div class="border border-current pl-2 text-justify">
                                <p id="show_out_contacto_email"></p>
                            </div>
                        </div>

                        <div class="mt-6" id="show_out_maquinas">
                        </div>

                        <div class="mt-6" id="show_out_horarios">
                        </div>

                        <div class="flex mt-6">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Tipo de
                                    Trabajo:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="show_out_rat_tipo"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Sintoma:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="show_out_rat_sintoma"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Desarrollo:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="show_out_rat_desarrollo"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify">
                                <strong>Observaciones:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="show_out_rat_observaciones"></p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Pendientes:</strong>
                            </div>
                            <div class="w-full border border-current pl-2 text-justify">
                                <p id="show_out_rat_pendientes"></p>
                            </div>
                        </div>

                        <div id="show_out_fotos" class="sm:grid px-2 py-2 mt-6 mb-5 w-full border border-current">
                        </div>

                    </div>
                </div>
            </div>
    </x-slot>
    <x-slot name="footer">
        <x-button id="btn_add"
            class="block mr-6 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Enviar Correo ✉</x-button>
        </form>
    </x-slot>
</x-add-rat-modal1>

<!--Ver RAT-->
<x-show-rat-modal name="rats-show2">
    <x-slot name="title">
        <div id="titulo_show2">
        </div>
    </x-slot>
    <x-slot name="body">
        <!--Detalles RAT -->
        <div class="lg:ml-20 lg:mr-20">
            <div class="grid grid-cols-2 justify-center">
                <div class="text-left">
                    <img src="{{ asset('/img/logo.jpg') }}" alt="..."
                        class="relative border-none p-2 align-middle" style="height: 140px" />
                </div>
                <div class="text-right">
                    <div style="color: rgb(53, 112, 155);" class="text-md">Mantención Desarrollo Ingeniería SpA
                    </div>
                    <div style="color: rgb(53, 112, 155);" class="text-md">RUT: 76.187.132 – 3</div>
                    <div style="color: rgb(53, 112, 155);" class="text-md">Dirección: Pasaje Los Fresnos # 431,
                        Villa
                        Padelpa, Mostazal</div>
                    <div style="color: rgb(53, 112, 155);" class="text-md">Fono: +56 9 3429 8279</div>
                    <div style="color: rgb(53, 112, 155);" class="text-md">Email: contacto@madein-eirl.cl</div>
                </div>
            </div>
            <div id="rats_show_rat_add">
                <div class="mt-5 text-center">
                    <div class="font-serif text-3xl underline underline-offset-4">Reporte de Asistencia Técnica
                    </div>
                </div>
                <div class="mt-5 mr-10 grid justify-end text-center">
                    <div class="h-10 w-60 rounded-md border-2 border-solid border-black pt-1">
                        <strong class="m-2" id="show_rat_rat_name"></strong>
                        <x-jet-input id="show_rat_rat_id" name="show_rat_rat_id" hidden />
                    </div>
                </div>

                <div class="flex-row">
                    <div class="flex border border-current mt-8">
                        <strong class="pl-2">Fechas: |</strong>
                        <div id="show_rat_rat_fecha" class="pl-1">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-4 sm:grid-cols-2">
                        <div class="border border-current pl-2 pr-2 text-justify">
                            <strong>Cliente:</strong>
                        </div>
                        <div class="border border-current pl-2 text-justify">
                            <p id="show_rat_cliente_name"></p>
                        </div>
                        <div class="border border-current pl-2 text-justify"><strong>Contacto:</strong>
                        </div>
                        <div class="border border-current pl-2 text-justify">
                            <p id="show_rat_contacto_name"></p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-4 sm:grid-cols-2">
                        <div class="border border-current pl-2 pr-2 text-justify"><strong>Fono:</strong></div>
                        <div class="border border-current pl-2 text-justify">
                            <p id="show_rat_contacto_phone"></p>
                        </div>
                        <div class="border border-current pl-2 text-justify"><strong>Correo:</strong></div>
                        <div class="border border-current pl-2 text-justify">
                            <p id="show_rat_contacto_email"></p>
                        </div>
                    </div>

                    <div class="mt-6" id="show_rat_maquinas">
                    </div>

                    <div class="mt-6" id="show_rat_horarios">
                    </div>

                    <div class="flex mt-6">
                        <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Tipo de
                                Trabajo:</strong>
                        </div>
                        <div class="w-full border border-current pl-2 text-justify">
                            <p id="show_rat_rat_tipo"></p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Sintoma:</strong>
                        </div>
                        <div class="w-full border border-current pl-2 text-justify">
                            <p id="show_rat_rat_sintoma"></p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Desarrollo:</strong>
                        </div>
                        <div class="w-full border border-current pl-2 text-justify">
                            <p id="show_rat_rat_desarrollo"></p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-48 border border-current pl-2 pr-2 text-justify">
                            <strong>Observaciones:</strong>
                        </div>
                        <div class="w-full border border-current pl-2 text-justify">
                            <p id="show_rat_rat_observaciones"></p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Pendientes:</strong>
                        </div>
                        <div class="w-full border border-current pl-2 text-justify">
                            <p id="show_rat_rat_pendientes"></p>
                        </div>
                    </div>

                    <div id="show_rat_fotos"
                        class="text-center sm:grid px-2 py-2 mt-6 mb-5 w-full border border-current">
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-show-rat-modal>

<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#dataTable').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            language: {
                url: '/js/datatable-es-cl.json'
            },
            processing: true,
            serverSide: true,
            ajax: '/getRats',
            columns: [{
                    data: 'id',
                    name: 'id',
                    responsivePriority: 1,
                    targets: -1
                },
                {
                    data: 'name',
                    name: 'name',
                    responsivePriority: 2,
                    targets: -1
                },
                {
                    data: 'name_cliente',
                    name: 'name_cliente',
                    responsivePriority: 3,
                    targets: -1
                },
                {
                    data: 'name_estado',
                    name: 'name_estado',
                    responsivePriority: 4,
                    targets: -1
                },
                {
                    data: 'contador',
                    name: 'contador',
                    responsivePriority: 5,
                    targets: -1
                },
                {
                    data: 'name_user',
                    name: 'name_user',
                    responsivePriority: 6,
                    targets: -1
                },
                {
                    data: 'name_estado',
                    render: function(data, type, row, meta) {
                        $btn = null;
                        switch (data) {
                            case 'Nuevo':
                                $btn = '<button onclick="FechaModal(' + row.id +
                                    ')" class="rounded mr-2 px-4 py-1 text-sm font-medium text-gray-100 border-b bg-blue-500 hover:bg-blue-400">➕ Fecha</button>' +
                                    '<button onclick="firmaModal(' + row.id +
                                    ')" class="rounded px-4 py-1 text-sm font-medium text-gray-100 border-b bg-orange-500 hover:bg-orange-400">🖊 Firmar</button>';
                                break;
                            case 'Firmado y validado':
                                $btn = '<button onclick="PDFyCorreoModal(' + row.id +
                                    ')" class="rounded px-4 py-1 text-sm font-medium text-gray-100 border-b bg-orange-500 hover:bg-orange-400">✉ Enviar Correo</button>';
                                break;
                            case 'Enviado correo / Resuelto':
                                $btn = '<button onclick="VerRatModal(' + row.id +
                                    ')" class="rounded px-4 py-1 text-sm font-medium text-gray-100 border-b bg-blue-500 hover:bg-blue-400">📋 Abrir</button>';
                                break;
                            case 'Archivado':
                                break;
                        }

                        return $btn;
                    },
                    responsivePriority: 9,
                    targets: -1
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    responsivePriority: 10,
                    targets: -1
                }
            ],
            order: [
                [0, 'desc']
            ],
            pageLength: 25,
        });

    });

    function agregarModal() {
        $('#rats-add-modal').toggle();
    }

    function editarModal(id) {
        $('#modal_rats_edit_rat_name').empty();
        $('#modal_rats_edit_fechas').empty();
        $('#modal_rats_edit_tipo').empty();
        $('#modal_rats_edit_cliente_name').empty();
        $('#modal_rats_edit_contacto_email').empty();
        $('#modal_rats_edit_contacto_name').empty();
        $('#modal_rats_edit_contacto_phone').empty();
        $('#modal_rats_edit_sintoma').empty();
        $('#modal_rats_edit_desarrollo').empty();
        $('#modal_rats_edit_observaciones').empty();
        $('#modal_rats_edit_pendientes').empty();
        $('#modal_rats_edit_maquinas').empty();
        $('#modal_rats_edit_horarios').empty();
        $('#modal_rats_edit_fotos').empty();

        $('#modal_rats_edit_sintoma_add').empty();
        $('#modal_rats_edit_desarrollo_add').empty();
        $('#modal_rats_edit_observaciones_add').empty();
        $('#modal_rats_edit_pendientes_add').empty();

        $('#rats-edit').toggle();
        $('#form_edit').attr('action', "/rats/" + id);

        $.ajax({
            type: "GET",
            url: "/getRat/" + id,
            success: function(data) {
                //console.log(data);
                $('#modal_rats_edit_rat_name_input').val(data.Rats.name);
                $('#modal_rats_edit_rat_name').append(data.Rats.name);
                $.each(data.Fechas, function(key, fecha) {
                    $('#modal_rats_edit_fechas').append(`<strong>` + fecha.name +
                        `</strong> | `);
                });
                $('#modal_rats_edit_tipo').append(data.Rats.tipo_rat);
                $('#modal_rats_edit_cliente_name').append(data.Cliente.name);
                $('#modal_rats_edit_contacto_email').append(data.Contacto.email);
                $('#modal_rats_edit_contacto_name').append(data.Contacto.name);
                $('#modal_rats_edit_contacto_phone').append(data.Contacto.phone);
                $('#modal_rats_edit_sintoma').append(data.Rats.sintoma);
                $('#modal_rats_edit_desarrollo').append(data.Rats.desarrollo);
                $('#modal_rats_edit_observaciones').append(data.Rats.observaciones);
                $('#modal_rats_edit_pendientes').append(data.Rats.pendientes);

                $.each(data.Maquinas, function(key, maquina) {
                    $('#modal_rats_edit_maquinas').append(`
                        <div class="grid md:grid-cols-6 sm:grid-cols-2 mt-1">
                            <div class="border border-current pl-2 pr-2 text-justify"><strong>Equipo:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.name3 + `
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Modelo:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.name2 + `
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>N°Serie:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.nro_serie + `
                            </div>
                        </div>
                    `);
                });

                $.each(data.Horarios, function(key, horario) {
                    $('#modal_rats_edit_horarios').append(`
                        <div class="mt-8 grid grid-cols-3">
                            <div class="border border-current text-center"><strong>Tiempo Ida</strong></div>
                            <div class="border border-current text-center"><strong>Tiempo Trabajo</strong></div>
                            <div class="border border-current text-center"><strong>Tiempo Regreso</strong></div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoTraslado + `
                                </div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoTrabajo + `
                                </div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoSalida + `
                                </div>
                        </div>
                        <div class="grid grid-cols-6">
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_traslado + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_traslado + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_trabajo + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_trabajo + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_salida + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_salida + `</div>
                        </div>
                    `);
                });
                $.each(data.Fotos, function(key, foto) {
                    $('#modal_rats_edit_fotos').append(`
                    <img class="h-64" src="{{ Storage::url('` + foto.path + `') }}"/>
                    `);
                });

                $('#modal_rats_edit_sintoma_add').append(data.Rats.sintoma);
                $('#modal_rats_edit_desarrollo_add').append(data.Rats.desarrollo);
                $('#modal_rats_edit_observaciones_add').append(data.Rats.observaciones);
                $('#modal_rats_edit_pendientes_add').append(data.Rats.pendientes);

            }
        });
    }

    function eliminarModal(id) {
        $("#rats-delete").toggle();
        $("#form_delete").attr("action", "/rats/" + id);
    }

    function FechaModal(id) {
        $('#modal_rats_fecha_rat_name').empty();
        $('#modal_rats_fecha_fechas').empty();
        $('#modal_rats_fecha_tipo').empty();
        $('#modal_rats_fecha_cliente_name').empty();
        $('#modal_rats_fecha_contacto_email').empty();
        $('#modal_rats_fecha_contacto_name').empty();
        $('#modal_rats_fecha_contacto_phone').empty();
        $('#modal_rats_fecha_sintoma').empty();
        $('#modal_rats_fecha_desarrollo').empty();
        $('#modal_rats_fecha_observaciones').empty();
        $('#modal_rats_fecha_pendientes').empty();
        $('#modal_rats_fecha_maquinas').empty();
        $('#modal_rats_fecha_horarios').empty();
        $('#modal_rats_fecha_fotos').empty();

        $('#modal_rats_fecha_sintoma_add').empty();
        $('#modal_rats_fecha_desarrollo_add').empty();
        $('#modal_rats_fecha_observaciones_add').empty();
        $('#modal_rats_fecha_pendientes_add').empty();

        $("#rats-fecha-add-modal").toggle();

        $.ajax({
            type: "GET",
            url: "/getRat/" + id,
            success: function(data) {
                //console.log(data);
                $('#modal_rats_fecha_rat_name_input').val(data.Rats.name);
                $('#modal_rats_fecha_rat_name').append(data.Rats.name);
                $.each(data.Fechas, function(key, fecha) {
                    $('#modal_rats_fecha_fechas').append(`<strong>` + fecha.name +
                        `</strong> | `);
                });
                $('#modal_rats_fecha_tipo').append(data.Rats.tipo_rat);
                $('#modal_rats_fecha_cliente_name').append(data.Cliente.name);
                $('#modal_rats_fecha_contacto_email').append(data.Contacto.email);
                $('#modal_rats_fecha_contacto_name').append(data.Contacto.name);
                $('#modal_rats_fecha_contacto_phone').append(data.Contacto.phone);
                $('#modal_rats_fecha_sintoma').append(data.Rats.sintoma);
                $('#modal_rats_fecha_desarrollo').append(data.Rats.desarrollo);
                $('#modal_rats_fecha_observaciones').append(data.Rats.observaciones);
                $('#modal_rats_fecha_pendientes').append(data.Rats.pendientes);

                $.each(data.Maquinas, function(key, maquina) {
                    $('#modal_rats_fecha_maquinas').append(`
                        <div class="grid md:grid-cols-6 sm:grid-cols-2 mt-1">
                            <div class="border border-current pl-2 pr-2 text-justify"><strong>Equipo:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.name3 + `
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Modelo:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.name2 + `
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>N°Serie:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.nro_serie + `
                            </div>
                        </div>
                    `);
                });

                $.each(data.Horarios, function(key, horario) {
                    $('#modal_rats_fecha_horarios').append(`
                        <div class="mt-8 grid grid-cols-3">
                            <div class="border border-current text-center"><strong>Tiempo Ida</strong></div>
                            <div class="border border-current text-center"><strong>Tiempo Trabajo</strong></div>
                            <div class="border border-current text-center"><strong>Tiempo Regreso</strong></div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoTraslado + `
                                </div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoTrabajo + `
                                </div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoSalida + `
                                </div>
                        </div>
                        <div class="grid grid-cols-6">
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_traslado + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_traslado + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_trabajo + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_trabajo + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_salida + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_salida + `</div>
                        </div>
                    `);
                });
                $.each(data.Fotos, function(key, foto) {
                    $('#modal_rats_fecha_fotos').append(`
                    <img class="h-64" src="{{ Storage::url('` + foto.path + `') }}"/>
                    `);
                });

                $('#modal_rats_fecha_sintoma_add').append(data.Rats.sintoma);
                $('#modal_rats_fecha_desarrollo_add').append(data.Rats.desarrollo);
                $('#modal_rats_fecha_observaciones_add').append(data.Rats.observaciones);
                $('#modal_rats_fecha_pendientes_add').append(data.Rats.pendientes);

            }
        });
    }


    function firmaModal(id) {
        $('#show_rat_name').empty();
        $('#show_rat_fecha').empty();
        $('#show_rat_tipo').empty();
        $('#show_cliente_name').empty();
        $('#show_contacto_email').empty();
        $('#show_contacto_name').empty();
        $('#show1_contacto_name').empty();
        $('#show_contacto_phone').empty();
        $('#show_rat_sintoma').empty();
        $('#show_rat_desarrollo').empty();
        $('#show_rat_observaciones').empty();
        $('#show_rat_pendientes').empty();
        $('#show_maquinas').empty();
        $('#show_horarios').empty();
        $('#show_fotos').empty();
        $("#rats-show").toggle();
        sig.signature('clear');
        $("#signature64").val('');
        $.ajax({
            type: "GET",
            url: "/getRat/" + id,
            success: function(data) {
                //console.log(data);
                $('#show_rat_name').append(data.Rats.name);
                $('#show_rat_id').val(id);
                $.each(data.Fechas, function(key, fecha) {
                    $('#show_rat_fecha').append(`<strong>` + fecha.name +
                        `</strong> | `);
                });
                $('#show_rat_tipo').append(data.Rats.tipo_rat);
                $('#show_cliente_name').append(data.Cliente.name);
                $('#show_contacto_email').append(data.Contacto.email);
                $('#show_contacto_name').append(data.Contacto.name);
                $('#show1_contacto_name').append(data.Contacto.name);
                $('#show_contacto_phone').append(data.Contacto.phone);
                $('#show_rat_sintoma').append(data.Rats.sintoma);
                $('#show_rat_desarrollo').append(data.Rats.desarrollo);
                $('#show_rat_observaciones').append(data.Rats.observaciones);
                $('#show_rat_pendientes').append(data.Rats.pendientes);
                $.each(data.Maquinas, function(key, maquina) {
                    $('#show_maquinas').append(`
                        <div class="grid md:grid-cols-6 sm:grid-cols-2 mt-4">
                            <div class="border border-current pl-2 pr-2 text-justify"><strong>Equipo:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.name3 + `
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Modelo:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.name2 + `
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>N°Serie:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.nro_serie + `
                            </div>
                        </div>
                    `);
                });
                $.each(data.Horarios, function(key, horario) {
                    //console.log(horario);
                    $('#show_horarios').append(`
                        <div class="mt-8 grid grid-cols-3">
                            <div class="border border-current text-center"><strong>Tiempo Ida</strong></div>
                            <div class="border border-current text-center"><strong>Tiempo Trabajo</strong></div>
                            <div class="border border-current text-center"><strong>Tiempo Regreso</strong></div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoTraslado + `
                                </div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoTrabajo + `
                                </div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoSalida + `
                                </div>
                        </div>
                        <div class="grid grid-cols-6">
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_traslado + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_traslado + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_trabajo + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_trabajo + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_salida + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_salida + `</div>
                        </div>
                    `);
                });
                $.each(data.Fotos, function(key, foto) {
                    $('#show_fotos').append(`
                    <img class="h-64" src="{{ Storage::url('` + foto.path + `') }}"/>
                    `);
                });
            }
        });
    }


    function PDFyCorreoModal(id) {
        $('#show_out_rat_name').empty();
        $('#show_out_rat_fecha').empty();
        $('#show_out_rat_tipo').empty();
        $('#show_out_cliente_name').empty();
        $('#show_out_contacto_email').empty();
        $('#show_out_contacto_name').empty();
        $('#show_out_contacto_phone').empty();
        $('#show_out_rat_sintoma').empty();
        $('#show_out_rat_desarrollo').empty();
        $('#show_out_rat_observaciones').empty();
        $('#show_out_rat_pendientes').empty();
        $('#show_out_maquinas').empty();
        $('#show_out_horarios').empty();
        $('#show_out_fotos').empty();
        $("#rats-show1").toggle();
        $.ajax({
            type: "GET",
            url: "/getRat/" + id,
            success: function(data) {
                //console.log(data);
                $('#show_out_rat_name').append(data.Rats.name);
                $('#show_out_rat_id').val(id);
                $.each(data.Fechas, function(key, fecha) {
                    $('#show_out_rat_fecha').append(`<strong>` + fecha.name +
                        `</strong> | `);
                });
                $('#show_out_rat_tipo').append(data.Rats.tipo_rat);
                $('#show_out_cliente_name').append(data.Cliente.name);
                $('#show_out_contacto_email').append(data.Contacto.email);
                $('#show_out_contacto_name').append(data.Contacto.name);
                $('#show_out_contacto_phone').append(data.Contacto.phone);
                $('#show_out_rat_sintoma').append(data.Rats.sintoma);
                $('#show_out_rat_desarrollo').append(data.Rats.desarrollo);
                $('#show_out_rat_observaciones').append(data.Rats.observaciones);
                $('#show_out_rat_pendientes').append(data.Rats.pendientes);
                $.each(data.Maquinas, function(key, maquina) {
                    $('#show_out_maquinas').append(`
                        <div class="grid md:grid-cols-6 sm:grid-cols-2 mt-4">
                            <div class="border border-current pl-2 pr-2 text-justify"><strong>Equipo:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.name3 + `
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Modelo:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.name2 + `
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>N°Serie:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.nro_serie + `
                            </div>
                        </div>
                    `);
                });
                $.each(data.Horarios, function(key, horario) {
                    //console.log(horario);
                    $('#show_out_horarios').append(`
                        <div class="mt-8 grid grid-cols-3">
                            <div class="border border-current text-center"><strong>Tiempo Ida</strong></div>
                            <div class="border border-current text-center"><strong>Tiempo Trabajo</strong></div>
                            <div class="border border-current text-center"><strong>Tiempo Regreso</strong></div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoTraslado + `
                                </div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoTrabajo + `
                                </div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoSalida + `
                                </div>
                        </div>
                        <div class="grid grid-cols-6">
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_traslado + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_traslado + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_trabajo + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_trabajo + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_salida + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_salida + `</div>
                        </div>
                    `);
                });
                $.each(data.Fotos, function(key, foto) {
                    $('#show_out_fotos').append(`
                    <img class="h-64" src="{{ Storage::url('` + foto.path + `') }}"/>
                    `);
                });
            }
        });
    }

    function VerRatModal(id) {
        $('#show_rat_rat_name').empty();
        $('#show_rat_rat_fecha').empty();
        $('#show_rat_rat_tipo').empty();
        $('#show_rat_cliente_name').empty();
        $('#show_rat_contacto_email').empty();
        $('#show_rat_contacto_name').empty();
        $('#show_rat_contacto_phone').empty();
        $('#show_rat_rat_sintoma').empty();
        $('#show_rat_rat_desarrollo').empty();
        $('#show_rat_rat_observaciones').empty();
        $('#show_rat_rat_pendientes').empty();
        $('#show_rat_maquinas').empty();
        $('#show_rat_horarios').empty();
        $('#show_rat_fotos').empty();
        $("#rats-show2").toggle();
        $.ajax({
            type: "GET",
            url: "/getRat/" + id,
            success: function(data) {
                //console.log(data);
                $('#show_rat_rat_name').append(data.Rats.name);
                $('#show_rat_rat_id').val(id);
                $.each(data.Fechas, function(key, fecha) {
                    $('#show_rat_rat_fecha').append(`<strong>` + fecha.name +
                        `</strong> | `);
                });
                $('#show_rat_rat_tipo').append(data.Rats.tipo_rat);
                $('#show_rat_cliente_name').append(data.Cliente.name);
                $('#show_rat_contacto_email').append(data.Contacto.email);
                $('#show_rat_contacto_name').append(data.Contacto.name);
                $('#show_rat_contacto_phone').append(data.Contacto.phone);
                $('#show_rat_rat_sintoma').append(data.Rats.sintoma);
                $('#show_rat_rat_desarrollo').append(data.Rats.desarrollo);
                $('#show_rat_rat_observaciones').append(data.Rats.observaciones);
                $('#show_rat_rat_pendientes').append(data.Rats.pendientes);
                $.each(data.Maquinas, function(key, maquina) {
                    $('#show_rat_maquinas').append(`
                        <div class="grid md:grid-cols-6 sm:grid-cols-2 mt-4">
                            <div class="border border-current pl-2 pr-2 text-justify"><strong>Equipo:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.name3 + `
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>Modelo:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.name2 + `
                            </div>
                            <div class="border border-current pl-2 text-justify"><strong>N°Serie:</strong>
                            </div>
                            <div class="border border-current pl-2 text-justify">` + maquina.nro_serie + `
                            </div>
                        </div>
                    `);
                });
                $.each(data.Horarios, function(key, horario) {
                    //console.log(horario);
                    $('#show_rat_horarios').append(`
                        <div class="mt-8 grid grid-cols-3">
                            <div class="border border-current text-center"><strong>Tiempo Ida</strong></div>
                            <div class="border border-current text-center"><strong>Tiempo Trabajo</strong></div>
                            <div class="border border-current text-center"><strong>Tiempo Regreso</strong></div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoTraslado + `
                                </div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoTrabajo + `
                                </div>
                            <div class="border border-current text-center">
                                ` + horario.tiempoSalida + `
                                </div>
                        </div>
                        <div class="grid grid-cols-6">
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center"><strong>Entrada</strong></div>
                            <div class="border border-current text-center"><strong>Salida</strong></div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_traslado + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_traslado + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_trabajo + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_trabajo + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_ini_salida + `</div>
                            <div class="border border-current text-center">
                                ` + horario.hora_fin_salida + `</div>
                        </div>
                    `);
                });
                $.each(data.Fotos, function(key, foto) {
                    $('#show_rat_fotos').append(`
                    <img class="h-64" src="{{ Storage::url('` + foto.path + `') }}"/>
                    `);
                });
            }
        });
    }


    function parseDate(str) {
        var mdy = str.split('-');
        return new Date(mdy[0] - 1, mdy[1], mdy[2]);
    }

    function datediff(first, second) {
        return Math.round((second - first) / (1000 * 60 * 60 * 24));
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

    var sig = $('#sig').signature({
        syncField: '#signature64',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>
