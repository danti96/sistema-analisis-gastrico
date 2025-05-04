<x-app-layout>

    <div class="bg-white shadow-sm rounded-md mb-2">
        <div class="border w-full p-2 flex justify-start">
            <a type="button" href="{{ route('paciente.index') }}"
                class="py-1 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                <i class="fa-solid fa-arrow-left"></i>
                Volver
            </a>
        </div>
        <template x-if="message!=''">
            <div class="border w-full p-2 flex justify-between">
                <div class="p-2 w-full bg-red-300 cursor-pointer">
                    <span class="font-bold underline decoration-solid" x-text="message"></span>
                </div>
            </div>
        </template>
    </div>

    <div class="sm:flex gap-4 w-full">

        <div class="max-w-md h-full grid">
            <div class="rounded-lg bg-white space-y-2 p-2">
                <div class="hidden sm:block w-full">
                    <img src="{{ asset('images/patient/patient.png') }}" alt="Profile Patient"
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
                <div class="flex justify-between">
                    <span class="font-medium">Altura</span>
                    <span class="font-medium">0.0 cm</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Peso</span>
                    <span class="font-medium">0.0 kg</span>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white w-full p-2 grid space-y-2">
            <div x-data="{ tab: 0 }" x-init="tab = 0">
                <div class="bg-white my-2 border shadow-sm rounded-md">
                    <div class="">
                        <button :class="tab == 0 ? 'bg-blue-400 font-semibold' : ''" @click="tab=0"
                            class="p-2 bg-blue-300 rounded-t-md hover:bg-blue-400 hover:font-semibold">Datos
                            Personales</button>
                        <button :class="tab == 1 ? 'bg-blue-400 font-semibold' : ''" @click="tab=1"
                            class="p-2 bg-blue-300 rounded-t-md hover:bg-blue-400 hover:font-semibold">Datos
                            Nacimiento</button>
                        <button :class="tab == 2 ? 'bg-blue-400 font-semibold' : ''" @click="tab=2"
                            class="p-2 bg-blue-300 rounded-t-md hover:bg-blue-400 hover:font-semibold">Datos
                            Familiares</button>
                        <button :class="tab == 3 ? 'bg-blue-400 font-semibold' : ''" @click="tab=3"
                            class="p-2 bg-blue-300 rounded-t-md hover:bg-blue-400 hover:font-semibold">Datos
                            Adicionales</button>
                        <button :class="tab == 4 ? 'bg-blue-400 font-semibold' : ''" @click="tab=4"
                            class="p-2 bg-blue-300 rounded-t-md hover:bg-blue-400 hover:font-semibold">
                            Documentos</button>
                    </div>
                </div>
                <div class="max-h-full p-2 border rounded-md w-full">
                    <template x-if="tab === 0">
                        <x-modules.paciente.forms.datos-personales
                            :paciente="$paciente"
                            :disabled="true"
                            :tipo_identificacion="$tipo_identificacion"
                            :grupos_familiares="$grupos_familiares"
                            :nivel_educacion="$nivel_educacion"
                            :estado_civil="$estado_civil"
                            :sexo="$sexo" />
                    </template>
                </template>
                <template x-if="tab === 1">
                    <x-modules.paciente.forms.datos-nacimientos
                        :paciente="$paciente"
                        :disabled="true"
                        :countries='$countries'
                        />
                </template>
                <template x-if="tab === 2">
                    <x-modules.paciente.forms.datos-familiar-table
                        :paciente="$paciente"
                        :disabled="true"
                        :tipo_identificacion="$tipo_identificacion"
                        :grupos_familiares="$grupos_familiares"
                        :sexo="$sexo" />
                </template>
                <template x-if="tab === 3">
                    <x-modules.paciente.forms.datos-adicionales
                        :paciente="$paciente"
                        :disabled="true"
                        :nivel_educacion="$nivel_educacion"
                        :estado_nivel_educacion="$estado_nivel_educacion" />
                </template>
                <template x-if="tab === 4">
                    <x-modules.paciente.forms.visualizar-documentos
                        :paciente="$paciente"
                        :disabled="true" />
                </template>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
