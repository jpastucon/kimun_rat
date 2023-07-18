<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

</head>

<body>

    <header>
        <div>
        </div>
    </header>

    <main>
        <div class="ml-24 mr-24 mt-10">
            <div class="flex">
                <div class="text-left">
                    <img class="pl-6" style="max-height: 150px" src="{{ asset('/img/u13CLE01.svg') }}" alt="..." />
                </div>
                <div class="text-right">
                    <div style="color: rgb(53, 112, 155);" class="text-sm pl-40">Mantención Desarrollo Ingeniería SpA
                    </div>
                    <div style="color: rgb(53, 112, 155);" class="text-sm pl-40">RUT: 76.187.132 – 3</div>
                    <div style="color: rgb(53, 112, 155);" class="text-sm pl-40">Dirección: Pasaje Los Fresnos # 431,
                        Villa
                        Padelpa, Mostazal</div>
                    <div style="color: rgb(53, 112, 155);" class="text-sm pl-40">Fono: +56 9 3429 8279</div>
                    <div style="color: rgb(53, 112, 155);" class="text-sm pl-40">Email: contacto@madein-eirl.cl</div>
                </div>
            </div>
        </div>
        <div class="ml-24 mr-24">
            <div class="mt-5 text-center">
                <div class="font-serif text-3xl underline underline-offset-4">Reporte de Asistencia Técnica
                </div>
            </div>

            <div class="mt-5 h-10 w-full text-center">
                <div class="rounded-md border-2 border-solid border-black pt-2 pb-2">
                    <strong class="m-2">{{ $Rat->name }}</strong>
                </div>
            </div>

            <div class="flex-row">
                <div class="mt-8 border border-current pl-2">
                    <strong class="pl-2">Fechas: |</strong>
                    @foreach ($Fechas as $fecha)
                        <strong>{{ $fecha->name }} |</strong>
                    @endforeach
                </div>

                <div class="flex">
                    <!--class="flex"-->
                        <div class="w-32 border border-current pl-2 pr-2 text-justify"><strong>Cliente:</strong></div>
                        <div class="w-1/2 border border-current pl-2 text-justify">{{ $Cliente->name }}</div>
                        <div class="w-32 border border-current pl-2 text-justify"><strong>Contacto:</strong></div>
                        <div class="w-1/2 border border-current pl-2 text-justify">{{ $Contacto->name }}</div>
                </div>

                <div class="flex">
                    <div class="w-32 border border-current pl-2 pr-2 text-justify"><strong>Fono:</strong></div>
                    <div class="w-1/2 border border-current pl-2 text-justify">{{ $Contacto->phone }}</div>
                    <div class="w-32 border border-current pl-2 text-justify"><strong>Correo:</strong></div>
                    <div class="w-1/2 border border-current pl-2 text-justify">{{ $Contacto->email }}</div>
                </div>

                <div class="mt-6">
                    @foreach ($Maquinas as $maquina_tmp)
                        <div class="flex md:flex-row">
                            <div class="w-56 border border-current pl-2 pr-2 text-justify"><strong>Equipo:</strong>
                            </div>
                            <div class="w-1/2 border border-current pl-2 text-justify">{{ $maquina_tmp->name3 }}</div>
                            <div class="w-56 border border-current pl-2 text-justify"><strong>Modelo:</strong></div>
                            <div class="w-1/2 border border-current pl-2 text-justify">{{ $maquina_tmp->name2 }}</div>
                            <div class="w-56 border border-current pl-2 text-justify"><strong>N°Serie:</strong></div>
                            <div class="w-1/2 border border-current pl-2 text-justify">{{ $maquina_tmp->nro_serie }}
                            </div>
                        </div>
                    @endforeach
                </div>
                @foreach ($Horarios as $horario)
                    <div class="mt-6 w-full flex md:flex-row">
                        <div class="w-full border border-current text-center"><strong>Tiempo Ida</strong></div>
                        <div class="w-full border border-current text-center"><strong>Tiempo Trabajo</strong></div>
                        <div class="w-full border border-current text-center"><strong>Tiempo Regreso</strong></div>
                    </div>
                    <div class="w-full flex md:flex-row">
                        <div class="w-full border border-current text-center">{{ $horario->tiempoTraslado }}</div>
                        <div class="w-full border border-current text-center">{{ $horario->tiempoTrabajo }}</div>
                        <div class="w-full border border-current text-center">{{ $horario->tiempoSalida }}</div>
                    </div>
                    <div class="w-full flex md:flex-row">
                        <div class="w-full border border-current text-center"><strong>Entrada</strong></div>
                        <div class="w-full border border-current text-center"><strong>Salida</strong></div>
                        <div class="w-full border border-current text-center"><strong>Entrada</strong></div>
                        <div class="w-full border border-current text-center"><strong>Salida</strong></div>
                        <div class="w-full border border-current text-center"><strong>Entrada</strong></div>
                        <div class="w-full border border-current text-center"><strong>Salida</strong></div>
                    </div>
                    <div class="w-full flex md:flex-row">
                        <div class="w-full border border-current text-center">
                            {{ date('H:i', strtotime($horario->hora_ini_traslado)) }}</div>
                        <div class="w-full border border-current text-center">
                            {{ date('H:i', strtotime($horario->hora_fin_traslado)) }}</div>
                        <div class="w-full border border-current text-center">
                            {{ date('H:i', strtotime($horario->hora_ini_trabajo)) }}</div>
                        <div class="w-full border border-current text-center">
                            {{ date('H:i', strtotime($horario->hora_fin_trabajo)) }}</div>
                        <div class="w-full border border-current text-center">
                            {{ date('H:i', strtotime($horario->hora_ini_salida)) }}</div>
                        <div class="w-full border border-current text-center">
                            {{ date('H:i', strtotime($horario->hora_fin_salida)) }}</div>
                    </div>
                @endforeach

                <div class="flex mt-6">
                    <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Trabajo:</strong>
                    </div>
                    <div class="w-full border border-current pl-2 text-justify">{{ $Rat->tipo_rat }}</div>
                </div>
                <div class="flex">
                    <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Sintoma:</strong></div>
                    <div class="w-full border border-current pl-2 text-justify">{{ $Rat->sintoma }}</div>
                </div>
                <div class="flex">
                    <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Desarrollo:</strong></div>
                    <div class="w-full border border-current pl-2 text-justify">{{ $Rat->desarrollo }}</div>
                </div>
                <div class="flex">
                    <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Observaciones:</strong></div>
                    <div class="w-full border border-current pl-2 text-justify">{{ $Rat->observaciones }}</div>
                </div>
                <div class="flex">
                    <div class="w-48 border border-current pl-2 pr-2 text-justify"><strong>Pendientes:</strong></div>
                    <div class="w-full border border-current pl-2 text-justify">{{ $Rat->pendientes }}</div>
                </div>
            </div>
        </div>
        <div style="page-break-before: always;"></div>
        <div class="ml-24 mr-24 mt-10">
            <div class="flex">
                <div class="text-left">
                    <img class="pl-8" style="max-height: 150px" src="{{ asset('/img/u13CLE01.svg') }}" alt="..." />
                </div>
                <div class="text-right">
                    <div style="color: rgb(53, 112, 155);" class="text-sm pl-48">Mantención Desarrollo Ingeniería SpA
                    </div>
                    <div style="color: rgb(53, 112, 155);" class="text-sm pl-48">RUT: 76.187.132 – 3</div>
                    <div style="color: rgb(53, 112, 155);" class="text-sm pl-48">Dirección: Pasaje Los Fresnos # 431,
                        Villa
                        Padelpa, Mostazal</div>
                    <div style="color: rgb(53, 112, 155);" class="text-sm pl-48">Fono: +56 9 3429 8279</div>
                    <div style="color: rgb(53, 112, 155);" class="text-sm pl-48">Email: contacto@madein-eirl.cl</div>
                </div>
            </div>
            @foreach ($Fotos as $foto)
                <div>
                    <img src="https://rat.kimunspa.cl/storage/{{ $foto->path }}" style="margin: 5mm" />
                </div>
            @endforeach

        </div>
    </main>

    <footer>
    </footer>
</body>

</html>
