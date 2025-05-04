@props(['disabled' => false, 'paciente'=>[], 'countries'=>[]])
<div class="bg-white my-2 border shadow-sm rounded-md">
    <div class="px-2 w-full py-2">
        <span class="text-gray-400 p-2">
            Datos de Nacimiento
        </span>
    </div>
    <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full">
        <div class="p-2">
            <x-components.label for="pais">País</x-components.label>
            <select @disabled($disabled) id="pais" name="pais"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $disabled ? 'border-transparent font-normal' : '' }}">
                <option value="">Seleccione</option>
                @foreach ($countries as $item)
                    <option value="{{ $item['name'] }}" @selected(old('pais', $paciente['pais'] ?? 'Ecuador') == $item['name'])>
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <x-components.input-group type="date" max="{{ date('Y-m-d') }}" name="fecha_nacimiento" label="Fecha de Nacimiento" placeholder="Fecha de Nacimiento" :disabled="$disabled" :value="old('fecha_nacimiento', isset($paciente['fecha_nacimiento']) ? $paciente['fecha_nacimiento'] : '')" />
        @if ($disabled)
            <x-components.input-group name="edad" label="Edad" placeholder="Edad" :disabled="$disabled" :value="old('edad', isset($paciente['edad']) ? $paciente['edad'] : '')" />
            <x-components.input-group name="meses" label="Meses" placeholder="0 mese(s)" :disabled="$disabled" :value="old('meses', isset($paciente['meses']) ? $paciente['meses'] : '')" />
            <x-components.input-group name="dias" label="Días" placeholder="0 día(s)" :disabled="$disabled" :value="old('dias', isset($paciente['dias']) ? $paciente['dias'] : '')" />
        @endif
    </div>
</div>
