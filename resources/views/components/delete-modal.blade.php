@props(['name'])

<div id="{{ $name }}" x-data="{ show: false }" x-show="show" style="display:block">

    <div class="main-modal fixed px-2 py-2 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
        id='modalDelete'>
        <div class="modal-overlay absolute bg-gray-900 opacity-50"></div>
        <div
            class="border border-gray-500 h-auto w-auto modal-container bg-white rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-3">
                    <p class="mt-8 text-2xl font-bold">{{ $title }}</p>
                    <button type="button" class="modal-close cursor-pointer z-50" data-dismiss="modal"
                        onclick="cerrarModalDelete()">
                        <svg class="fill-current text-black" xmlns="https://www.w3.org/2000/svg" width="18"
                            height="18" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </button>
                </div>
                <!--Body-->
                <div class="my-5">
                    {{ $body }}
                </div>
                <!--Footer-->
                <div class="flex justify-end mt-2 pt-2">
                    {{ $footer }}
                    <p></p>
                    <button onclick="cerrarModalDelete()"
                        class="focus:outline-none modal-close px-4 bg-red-400 py-2 rounded-lg text-white hover:bg-red-500">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
