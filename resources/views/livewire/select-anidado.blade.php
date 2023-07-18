<div>
    <x-jet-label for="m_tipo_id_add" value="{{ __('Tipo de Maquina') }}" class="mt-2" />
    <select wire:model="selectTipo" name="tipo_maquinas_id"
        class="form-select appearance-none block w-full mt-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
        <option value="">Seleccione el tipo de maquina</option>
        @foreach ($tipos as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
        @endforeach
    </select>
    @if (!is_null($marcas))
        <x-jet-label for="m_marca_id_add" value="{{ __('Marca') }}" class="mt-2" />
        <select wire:model="selectMarca" name="marca_id"
            class="form-select appearance-none block w-full mt-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            <option value="">Seleccione la Marca</option>
            @foreach ($marcas as $marca)
                <option value="{{ $marca->id }}">{{ $marca->name }}</option>
            @endforeach
        </select>
    @endif
    @if (!is_null($modelos))
        <x-jet-label for="m_modelo_id_add" value="{{ __('Modelo') }}" class="mt-2" />
        <select wire:model="selectModelo" name="modelo_id"
            class="form-select appearance-none block w-full mt-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            <option value="">Seleccione el Modelo</option>
            @foreach ($modelos as $modelo)
                <option value="{{ $modelo->id }}">{{ $modelo->name }}</option>
            @endforeach
        </select>
    @endif
</div>
