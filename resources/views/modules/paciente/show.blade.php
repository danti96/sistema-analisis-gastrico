@push('scripts')
    <script>
        const componentCreatePaciente = () => {
            return {
                form: {
                    apellidos: `{{ $paciente['apellidos'] }}`,
                    nombres: `{{ $paciente['nombres'] }}`,
                    estado_civil: `{{ $paciente['estado_civil'] }}`,
                    sexo: `{{ $paciente['sexo'] }}`,
                    tipo_identificacion: `{{ $paciente['tipo_identificacion'] }}`,
                    identificacion: `{{ $paciente['identificacion'] }}`,
                    correo: `{{ $paciente['correo'] }}`,
                    celular: `{{ $paciente['celular'] }}`,
                    region: `{{ $paciente['region'] }}`,
                    ciudad: `{{ $paciente['ciudad'] }}`,
                    direccion: `{{ $paciente['direccion'] }}`,
                    fecha_nacimiento: `{{ $paciente['fecha_nacimiento'] }}`,
                }
            };
        }
    </script>
@endpush
<x-app-layout>
    <div x-data="componentCreatePaciente()">


        <div class="bg-white shadow-sm rounded-md mb-2">
            <div class="border w-full p-2 flex justify-start">
                <a type="button" href="{{ route('paciente.index') }}"
                    class="py-1 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <i class="fa-solid fa-arrow-left"></i>
                    Volver
                </a>
            </div>
        </div>

        <div class="sm:flex gap-4 w-full p-4">

            <div class="max-w-md h-full grid">
                <div class="rounded-lg bg-white space-y-2 p-2">
                    <div class="hidden sm:block w-full">
                        <img src="{{ asset('/storage/images/user-profile.jpg') }}" alt="Profile Patient"
                            class="border rounded-lg max-h-64 w-full">
                    </div>

                    <div>
                        <span class="font-medium text-md sm:text-xl">
                            {{ $paciente['fullname'] }}
                        </span>
                    </div>

                    <div>
                        @if ($paciente['status'] == 1)
                            <span class="text-blue-700 font-bold sm:font-medium">
                                Habilitado
                            </span>
                        @else
                            <span class="text-red-700 font-bold sm:font-medium">
                                Deshabilitado
                            </span>
                        @endif
                    </div>

                    <div class="flex justify-between">
                        <span class="font-medium">Sexo</span>
                        <span class="font-medium">{{ $paciente['sexo'] == 'F' ? 'Femenino' : 'Masculino' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Edad</span>
                        <span class="font-medium">{{ $paciente['edad'] }} años</span>
                    </div>
                </div>
            </div>


            <div class="bg-white border shadow-sm rounded-md">

                <div class="max-h-full p-2 border rounded-md w-full">
                    <div class="bg-white my-2 border shadow-sm rounded-md">
                        <div class="px-2 w-full py-2">
                            <span class="text-gray-400 p-2">
                                <i class="fa-light fa-house"></i>
                                Datos Personales
                            </span>
                        </div>
                        <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full">

                            <x-components.input-group x-model="form.apellidos" name="apellidos" label="Apellidos" disabled="disabled" placeholder="Apellidos"/>

                            <x-components.input-group x-model="form.nombres" name="nombres" label="Nombres" disabled="disabled" placeholder="Nombres"/>

                            <x-components.input-group x-model="form.estado_civil" name="estado_civil" label="Estado Civil" disabled="disabled" placeholder="Estado Civil"/>

                            <x-components.input-group x-model="form.sexo" name="sexo" label="Sexo" disabled="disabled" placeholder="Sexo"/>

                            <x-components.input-group x-model="form.tipo_identificacion" name="tipo_identificacion" label="Tipo Identificación" disabled="disabled" placeholder="Tipo Identificación"/>

                            <x-components.input-group x-model="form.identificacion" name="identificacion" disabled="disabled" label="Identificación" placeholder="Identificación"/>

                            <x-components.input-group x-model="form.correo" name="correo" label="Correo" disabled="disabled" placeholder="example@dominio.com"/>

                            <x-components.input-group x-model="form.celular" name="celular" label="Celular" disabled="disabled" placeholder="09 #### ####"/>

                        </div>
                    </div>

                    <div class="bg-white my-2 border shadow-sm rounded-md">
                        <div class="px-2 w-full py-2">
                            <span class="text-gray-400 p-2">
                                Datos de Residencia
                            </span>
                        </div>
                        <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full">
                            <x-components.input-group x-model="form.region" name="region" label="Región/Provincia" disabled="disabled" placeholder="Región/Provincia"/>

                            <x-components.input-group x-model="form.ciudad" name="ciudad" label="Ciudad" disabled="disabled" placeholder="Ciudad"/>

                            <x-components.input-group x-model="form.direccion" name="direccion" label="Dirección" disabled="disabled" placeholder="Dirección"/>
                        </div>
                    </div>


                    <div class="bg-white my-2 border shadow-sm rounded-md">
                        <div class="px-2 w-full py-2">
                            <span class="text-gray-400 p-2">
                                Datos de Nacimiento
                            </span>
                        </div>
                        <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full">
                            <x-components.input-group x-model="form.fecha_nacimiento" type="date" disabled="disabled" max="{{ date('Y-m-d') }}" name="fecha_nacimiento" label="Fecha de Nacimiento" placeholder="Fecha de Nacimiento"/>
                        </div>
                    </div>


                </div>
            </div>


        </div>


    </div>
</x-app-layout>
