@props(['disabled' => false, 'paciente'=>[] ,'grupos_familiares'=>[], 'sexo'=>[], 'tipo_identificacion'=>[]])
<div class="bg-white my-2 border shadow-sm rounded-md">
    <div class="px-2 w-full py-2">
        <span class="text-gray-400 p-2">
            Detalle Del Familiar:
        </span>
    </div>
    @forelse ($paciente['familiares'] as $item)
        <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full border-b">
            <div class="md:col-span-5">
                <span
                    class="w-full px-2 py-2 text-md md:text-xl border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 font-bold dark:border-gray-600 dark:focus:ring-gray-700">
                    {{ $item['fullname'] }}
                </span>
                <b> - </b>
                <span
                    class="w-full px-2 py-2 text-md md:text-xl border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 font-bold dark:border-gray-600 dark:focus:ring-gray-700">
                    {{ $item['parentesco_nombre'] }}
                </span>
            </div>
            <div class="p-2">
                <x-components.label for="fecha-nacimiento">Fecha de Nacimiento </x-components.label>
                <span class="block mb-2 text-sm font-medium text-gray-900 justify-center dark:text-white">
                    {{ $item['fecha_nacimiento'] }}
                </span>
            </div>
            <div class="p-2">
                <x-components.label for="edad">Edad</x-components.label>
                <span class="block mb-2 text-sm font-medium text-gray-900 justify-center dark:text-white">
                    {{ $item['edad'] }}
                </span>
            </div>
            <div class="p-2">
                <x-components.label for="sexo">Sexo </x-components.label>
                <span class="block mb-2 text-sm font-medium text-gray-900 justify-center dark:text-white">
                    {{ $item['sexo'] == 'M' ? 'Masculino' : ($item['sexo'] == 'F' ? 'Femenino' : 'Otros') }}
                </span>
            </div>
            <div class="p-2">
                <x-components.label for="tipo-identificacion">Tipo Identificación </x-components.label>
                <span class="block mb-2 text-sm font-medium text-gray-900 justify-center dark:text-white">
                    {{ $item['tipo_identificacion_nombre'] }}
                </span>
            </div>
            <div class="p-2">
                <x-components.label for="identificacion">Identificación </x-components.label>
                <span class="block mb-2 text-sm font-medium text-gray-900 justify-center dark:text-white">
                    {{ $item['identificacion'] }}
                </span>
            </div>
            <div class="p-2">
                <x-components.label for="celular">Celular 1</x-components.label>
                <span class="block mb-2 text-sm font-medium text-gray-900 justify-center dark:text-white">
                    {{ $item['celular_1'] }}
                </span>
            </div>
            <div class="p-2">
                <x-components.label for="celular">Celular 2</x-components.label>
                <span class="block mb-2 text-sm font-medium text-gray-900 justify-center dark:text-white">
                    {{ $item['celular_2'] }}
                </span>
            </div>
            <div class="p-2">
                <x-components.label for="telefono">Teléfono</x-components.label>
                <span class="block mb-2 text-sm font-medium text-gray-900 justify-center dark:text-white">
                    {{ $item['telefono'] }}
                </span>
            </div>
            <div class="p-2">
                <x-components.label for="ocupacion">Ocupación</x-components.label>
                <span class="block mb-2 text-sm font-medium text-gray-900 justify-center dark:text-white">
                    {{ $item['ocupacion'] }}
                </span>
            </div>
            <div class="p-2">
                <x-components.label for="direccion">Dirección</x-components.label>
                <span class="block mb-2 text-sm font-medium text-gray-900 justify-center dark:text-white">
                    {{ $item['direccion'] }}
                </span>
            </div>
        </div>
    @empty
        <div class="px-2 w-full py-2">
            <span class="text-gray-800 font-medium p-2">
                No se ha registrado información de un familiar.
            </span>
        </div>
    @endforelse
</div>
