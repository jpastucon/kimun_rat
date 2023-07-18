<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-500 uppercase tracking-wider leading-tight">
            {{ __('Registros de Atención Técnica') }}
        </h2>
    </x-slot>
    <div>
        <div class="shadow-lg">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                    <div class="px-2 py-2 shadow overflow-x-auto border-b border-gray-200 sm:rounded-lg ">
                        <div class="py-2 px-2 text-center">
                            <div class="align-middle inline-block min-w-half sm:px-6 lg:px-8 flex justify-center m-auto">
                                <button type="button" onclick="agregarModal()"
                                    class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                    &nbsp✚&nbspNuevo RAT&nbsp&nbsp</button>
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
                                        CLIENTE
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        # Maquinas
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Nombre RAT
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        TIPO
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Fecha
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Hora Traslado
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Hora Entrada
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking">
                                        Hora Salida
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
<x-add-modal name="rats-add-modal">
    <x-slot name="title">
        🆕 -- Nuevo Registro de Atención Técnica --
    </x-slot>
    <x-slot name="body">
        <form id="form_add" method="POST" action="/rats">
            @csrf
            <div class="flex -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_name_add" value="{{ __('Título del Registro') }}"
                        class="text-base font-bold mt-2" />
                    <x-jet-input id="rat_name_add" name="name"
                        class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                        type="text" value="" required />
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_contacto_id_add" value="{{ __('Contacto') }}"
                        class="text-base font-bold mt-2" />
                    <select id="rat_contacto_id_add" name="contacto_id" type="text"
                        class="form-select w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50">
                        <option disabled selected>Seleccione un Contacto</option>
                        @foreach ($contactos as $contacto)
                            <option value="{{ $contacto->id }}">{{ $contacto->name }}</option>
                        @endforeach
                    </select>
                    <div
                        class="w-full select-none border-l-4 border-blue-400 bg-blue-100 p-4 font-medium hover:border-blue-500">
                        Si no se encuentra en listado se debe agregar un
                        <a href="{{ route('contactos') }}" target="_blank"><strong>nuevo contacto</strong></a>
                    </div>
                </div>
            </div>
            <div class="flex -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_tipo_rat_add" value="{{ __('Tipo de RAT') }}"
                        class="text-base font-bold mt-2" />
                    <select id="rat_tipo_rat_add" name="tipo_rat" type="text"
                        class="form-select appearance-none block w-full mt-2 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option disabled selected>Selecciona un Tipo de Registro</option>
                        <option value="Correctivo">Correctivo</option>
                        <option value="Preventivo">Preventivo</option>
                        <option value="Instalación">Instalación</option>
                        <option value="Capacitación">Capacitación</option>
                        <option value="Cotizado">Cotizado</option>
                        <option value="Inspección">Inspección</option>
                    </select>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_fecha_add" value="{{ __('Fecha RAT') }}" class="text-base font-bold mt-2" />
                    <x-datepicker id="rat_fecha_add" name="fecha">
                    </x-datepicker>
                </div>
            </div>
            <div class="flex -mx-3 mb-6 text-center">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_hora_traslado_add" value="{{ __('Hora de Traslado') }}"
                        class="text-base font-bold mt-2" />
                    <x-timepicker id="rat_hora_traslado_add" name="hora_traslado">
                    </x-timepicker>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_hora_entrada_add" value="{{ __('Hora de Entrada') }}"
                        class="text-base font-bold mt-2" />

                    <x-timepicker id="rat_hora_entrada_add" name="hora_entrada">
                    </x-timepicker>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_hora_salida_add" value="{{ __('Hora de Salida') }}"
                        class="text-base font-bold mt-2" />

                    <x-timepicker id="rat_hora_salida_add" name="hora_salida">
                    </x-timepicker>
                </div>
            </div>
            <div class="text-center">
                ------------------------
                <x-jet-label for="rat_sintoma_id_add" value="{{ __('Maquinas-Fotos Asociadas') }}"
                    class="text-base font-bold" />
                ------------------------
            </div>
            <div class="flex -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_sintoma_id_add" value="{{ __('Sintoma') }}"
                        class="text-base font-bold mt-2" />
                    <textarea id="rat_sintoma_id_add" name="sintoma"
                        class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        rows="3" placeholder="Escriba aquí el sintoma/análisis"></textarea>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_desarrollo_id_add" value="{{ __('Desarrollo') }}"
                        class="text-base font-bold mt-2" />
                    <textarea id="rat_desarrollo_id_add" name="desarrollo"
                        class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        rows="3" placeholder="Escriba aquí el desarrollo"></textarea>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_observaciones_id_add" value="{{ __('Observaciones') }}"
                        class="text-base font-bold mt-2" />
                    <textarea id="rat_observaciones_id_add" name="observaciones"
                        class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        rows="3" placeholder="Escriba aquí las observaciones"></textarea>
                </div>
            </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-end mt-2 pt-2">
            <button type="button" onclick="cerrarModalAdd()"
                class="focus:outline-none modal-close px-4 bg-red-400 py-2 rounded-lg text-white hover:bg-red-500">Cancelar</button>

            <x-button id="btn_add"
                class="focus:outline-none px-4 bg-green-600 p-3 ml-3 rounded-lg text-white hover:bg-green-800">
                Guardar
                cambios</x-button>
        </div>
        </form>
    </x-slot>

</x-add-modal>

<!--Editar-->
<x-edit-modal name="rats-edit">
    <x-slot name="title" id="titulo_edit">
        Editando R.A.T ✏
    </x-slot>
    <x-slot name="body">
        <form method="POST" action="/rats/" id="form_edit">
            @csrf
            {{ method_field('PUT') }}
            <div class="flex -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_user_id_edit" value="{{ __('Usuario') }}" class="mt-2" />

                    <div
                        class="w-full mb-2 select-none border-l-4 border-blue-400 bg-blue-100 p-4 font-medium hover:border-blue-500">
                        Si no se encuentra en listado se debe agregar un nuevo contacto!</div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_name_edit" value="{{ __('Nombre') }}" class="mt-2" />
                    <x-jet-input id="rat_name_edit" name="name" class="block mt-2 w-full" type="text"
                        value="" required />
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_contacto_id_edit" value="{{ __('Contacto') }}" class="mt-2" />
                    <select id="rat_contacto_id_edit" name="contacto_id" type="text"
                        class="form-select appearance-none block w-full mt-2 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option disabled selected>Seleccione un Contacto</option>
                        @foreach ($contactos as $contacto)
                            <option value="{{ $contacto->id }}" @selected(old('contacto_id') == $contacto->id)>
                                {{ $contacto->name }}
                            </option>
                        @endforeach
                    </select>
                    <div
                        class="w-full mb-2 select-none border-l-4 border-blue-400 bg-blue-100 p-4 font-medium hover:border-blue-500">
                        Si no se encuentra en listado se debe agregar un nuevo contacto!</div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_tipo_rat_edit" value="{{ __('Tipo de RAT') }}" class="mt-2" />
                    <select id="rat_tipo_rat_edit" name="tipo_rat" type="text"
                        class="form-select appearance-none block w-full mt-2 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option disabled selected>Seleccione un Tipo</option>
                        <option value="Correctivo">Correctivo</option>
                        <option value="Preventivo">Preventivo</option>
                        <option value="Instalación">Instalación</option>
                        <option value="Capacitación">Capacitación</option>
                        <option value="Cotizado">Cotizado</option>
                        <option value="Inspección">Inspección</option>
                    </select>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_fecha_edit" value="{{ __('Fecha RAT') }}" class="mt-2" />
                    <div class="datepicker relative form-floating mb-3 xl:w-96" data-mdb-toggle-button="false">
                        <input type="text" id="rat_fecha_edit" name="fecha"
                            class="form-control block w-full px-3 py-1.5 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Seleccione una fecha" data-mdb-toggle="datepicker" />
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_hora_traslado_edit" value="{{ __('Hora de Traslado') }}" class="mt-2" />
                    <div class="timepicker relative form-floating mb-3 xl:w-96" data-mdb-with-icon="false"
                        id="input-toggle-timepicker">
                        <input type="text" id="rat_hora_traslado_edit" name="hora_traslado"
                            class="form-control block w-full px-3 py-1.5 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Selecciona una hora" data-mdb-toggle="input-toggle-timepicker" />
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_hora_entrada_edit" value="{{ __('Hora de Entrada') }}" class="mt-2" />
                    <div class="timepicker relative form-floating mb-3 xl:w-96" data-mdb-with-icon="false"
                        id="input-toggle-timepicker">
                        <input type="text" id="rat_hora_entrada_edit" name="hora_entrada"
                            class="form-control block w-full px-3 py-1.5 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Selecciona una hora" data-mdb-toggle="input-toggle-timepicker" />
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_hora_salida_edit" value="{{ __('Hora de Salida') }}" class="mt-2" />
                    <div class="timepicker relative form-floating mb-3 xl:w-96" data-mdb-with-icon="false"
                        id="input-toggle-timepicker">
                        <input type="text" id="rat_hora_salida_edit" name="hora_salida"
                            class="form-control block w-full px-3 py-1.5 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Selecciona una hora" data-mdb-toggle="input-toggle-timepicker" />
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                SECCION MAQUINAS
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_sintoma_edit" value="{{ __('Sintoma') }}" class="mt-2" />
                    <textarea id="rat_sintoma_edit" name="sintoma"
                        class="form-control block w-full px-3 py-1.5 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        rows="3" placeholder="Registre aquí el sintoma"></textarea>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_desarrollo_edit" value="{{ __('Desarrollo') }}" class="mt-2" />
                    <textarea id="rat_desarrollo_edit" name="desarrollo"
                        class="form-control block w-full px-3 py-1.5 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        rows="3" placeholder="Registre aquí el desarrollo"></textarea>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="rat_observaciones_edit" value="{{ __('Observaciones') }}" class="mt-2" />
                    <textarea id="rat_observaciones_edit" name="observaciones"
                        class="form-control block w-full px-3 py-1.5 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        rows="3" placeholder="Registre aquí el observaciones"></textarea>
                </div>
            </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-end mt-2 pt-2">
            <button onclick="cerrarModalEdit()" type="button"
                class="focus:outline-none modal-close px-4 bg-gray-400 py-2 rounded-lg text-white hover:bg-gray-500">Cancelar</button>
            <x-button type="submit"
                class="focus:outline-none px-4 bg-gray-600 p-3 ml-3 rounded-lg text-white hover:bg-gray-800">
                Guardar cambios</x-button>
        </div>
        </form>

    </x-slot>
</x-edit-modal>

<!--Detalles-->
<x-show-modal name="rats-show">
    <x-slot name="title" id="titulo_show">
        👁‍🗨 -- Detalles del Registro de Atención Técnica --
    </x-slot>
    <x-slot name="body">
        <div class="flex -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="rat_name_show" value="{{ __('Título del Registro') }}"
                    class="text-base font-bold mt-2" />
                <x-jet-input id="rat_name_show" name="name"
                    class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                    type="text" value="" required readonly />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="rat_contacto_id_show" value="{{ __('Contacto') }}"
                    class="text-base font-bold mt-2" />
                <select id="rat_contacto_id_show" name="contacto_id" type="text"
                    class="form-select w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50">
                    <option disabled selected>Seleccione un Contacto</option>
                    @foreach ($contactos as $contacto)
                        <option value="{{ $contacto->id }}">{{ $contacto->name }}</option>
                    @endforeach
                </select>
                <div
                    class="w-full select-none border-l-4 border-blue-400 bg-blue-100 p-4 font-medium hover:border-blue-500">
                    Si no se encuentra en listado se debe agregar un
                    <a href="{{ route('contactos') }}" target="_blank"><strong>nuevo contacto</strong></a>
                </div>
            </div>
        </div>
        <div class="flex -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="rat_tipo_rat_show" value="{{ __('Tipo de RAT') }}"
                    class="text-base font-bold mt-2" />
                <select id="rat_tipo_rat_show" name="tipo_rat" type="text"
                    class="form-select appearance-none block w-full mt-2 text-base font-bold font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    <option disabled selected>Selecciona un Tipo de Registro</option>
                    <option value="Correctivo">Correctivo</option>
                    <option value="Preventivo">Preventivo</option>
                    <option value="Instalación">Instalación</option>
                    <option value="Capacitación">Capacitación</option>
                    <option value="Cotizado">Cotizado</option>
                    <option value="Inspección">Inspección</option>
                </select>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="rat_fecha_show" value="{{ __('Fecha RAT') }}" class="text-base font-bold mt-2" />
                <x-datepicker id="rat_fecha_show" name="fecha">
                </x-datepicker>
            </div>
        </div>
        <div class="flex -mx-3 mb-6 text-center">
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="rat_hora_traslado_show" value="{{ __('Hora de Traslado') }}"
                    class="text-base font-bold mt-2" />
                <x-timepicker id="rat_hora_traslado_show" name="hora_traslado">
                </x-timepicker>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="rat_hora_entrada_show" value="{{ __('Hora de Entrada') }}"
                    class="text-base font-bold mt-2" />

                <x-timepicker id="rat_hora_entrada_show" name="hora_entrada">
                </x-timepicker>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="rat_hora_salida_show" value="{{ __('Hora de Salida') }}"
                    class="text-base font-bold mt-2" />

                <x-timepicker id="rat_hora_salida_show" name="hora_salida">
                </x-timepicker>
            </div>
        </div>
        <div class="text-center">
            ------------------------
            <x-jet-label for="rat_sintoma_id_show" value="{{ __('Maquinas Asociadas') }}"
                class="text-base font-bold" />
            ------------------------
        </div>
        <div class="flex -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="rat_sintoma_id_show" value="{{ __('Sintoma') }}"
                    class="text-base font-bold mt-2" />
                <textarea id="rat_sintoma_id_show" name="sintoma"
                    class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    rows="3" placeholder="Escriba aquí el sintoma/análisis"></textarea>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="rat_desarrollo_id_show" value="{{ __('Desarrollo') }}"
                    class="text-base font-bold mt-2" />
                <textarea id="rat_desarrollo_id_show" name="desarrollo"
                    class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    rows="3" placeholder="Escriba aquí el desarrollo"></textarea>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-jet-label for="rat_observaciones_id_show" value="{{ __('Observaciones') }}"
                    class="text-base font-bold mt-2" />
                <textarea id="rat_observaciones_id_show" name="observaciones"
                    class="form-control block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    rows="3" placeholder="Escriba aquí las observaciones"></textarea>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-end mt-2 pt-2">
            <button onclick="cerrarModalShow()" type="button"
                class="focus:outline-none modal-close px-4 bg-gray-400 py-2 rounded-lg text-white hover:bg-gray-500">Cerrar</button>
        </div>
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
            ajax: '/getRats',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name_cliente',
                    name: 'name_cliente'
                },
                {
                    data: 'contador',
                    name: 'contador'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'tipo_rat',
                    name: 'tipo_rat'
                },
                {
                    data: 'fecha',
                    name: 'fecha'
                },
                {
                    data: 'hora_traslado',
                    name: 'hora_traslado'
                },
                {
                    data: 'hora_entrada',
                    name: 'hora_entrada'
                },
                {
                    data: 'hora_salida',
                    name: 'hora_salida'
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
        $('#rats-add-modal').toggle();
    }

    function editarModal(id) {
        $('#rats-edit').toggle();
        $('#form_edit').attr('action', "/rats/" + id);
        $.ajax({
            url: "/getRat/" + id,
            success: function(result) {
                $('#titulo_edit').text('Editando R.A.T ✏ ID ' + result.id);
                $('#rat_contacto_id_edit').find('option[value="' + result.contacto_id + '"]').prop(
                    'selected', true);
                $('#rat_user_id_edit').find('option[value="' + result.user_id + '"]').prop('selected',
                    true);
                $("#rat_name_edit").attr("value", result.name);
                $("#rat_tipo_rat_edit").attr("value", result.tipo_rat);
                $("#rat_fecha_edit").attr("value", result.fecha);
                $("#rat_hora_traslado_edit").attr("value", result.hora_traslado);
                $("#rat_hora_entrada_edit").attr("value", result.hora_entrada);
                $("#rat_hora_salida_edit").attr("value", result.hora_salida);
                $("#rat_sintoma_edit").attr("value", result.sintoma);
                $("#rat_desarrollo_edit").attr("value", result.desarrollo);
                $("#rat_observaciones_edit").attr("value", result.observaciones);
            }
        });
    }

    function detalleModal(id) {
        $("#rats-show").toggle();
        $.ajax({
            url: "/getRat/" + id,
            success: function(result) {
                $('#titulo_show').text('Detalles del RAT ID ' + result.id);
                $('#rat_contacto_id_show').find('option[value="' + result.contacto_id + '"]').prop(
                    'selected', true);
                $('#rat_user_id_show').find('option[value="' + result.user_id + '"]').prop('selected',
                    true);
                $("#rat_name_show").attr("value", result.name);
                $('#rat_tipo_rat_show').find('option[value="' + result.tipo_rat + '"]').prop('selected',
                    true);
                $("#rat_fecha_show").attr("value", result.fecha);
                $("#rat_hora_traslado_show").attr("value", result.hora_traslado);
                $("#rat_hora_entrada_show").attr("value", result.hora_entrada);
                $("#rat_hora_salida_show").attr("value", result.hora_salida);
                $("#rat_sintoma_show").attr("value", result.sintoma);
                $("#rat_desarrollo_show").attr("value", result.desarrollo);
                $("#rat_observaciones_show").attr("value", result.observaciones);
            }
        });
    }
</script>
