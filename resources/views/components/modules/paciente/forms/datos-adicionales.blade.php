@props(['disabled' => false,'nivel_educacion'=>[], 'paciente'=>[],'estado_nivel_educacion'=>[]])
<div class="bg-white my-2 border shadow-sm rounded-md">
    <div class="px-2 w-full py-2">
        <span class="text-gray-400 p-2">
            Datos de Adicionales:
        </span>
    </div>
    <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full">

        <x-components.select-field name="nivel_educacion" label="Nivel de Educación" :options="$nivel_educacion" :selected="old('nivel_educacion', $paciente['nivel_educacion'] ?? '')" :disabled="$disabled"  @input="removeError($event)" />
        <x-components.select-field name="estado_nivel_educacion" label="Estado" :options="$estado_nivel_educacion" :selected="old('estado_nivel_educacion', $paciente['estado_nivel_educacion'] ?? '')" :disabled="$disabled"  @input="removeError($event)" />

        <div class="p-2">
            <x-components.label for="seguro_iess">Seguro IESS </x-components.label>
            <select @disabled($disabled) id="seguro_iess" name="seguro_iess"  @input="removeError($event)"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $disabled ? 'border-transparent font-normal' : '' }}">
                <option value="" selected>Seleccione</option>
                <option value="true" @selected(true === old('seguro_iess', $paciente['seguro_iess'] ?? ''))>Si</option>
                <option value="false" @selected(false === old('seguro_iess', $paciente['seguro_iess'] ?? ''))>No</option>
            </select>
        </div>

        <div class="p-2">
            <x-components.label for="seguro_privado">Seguro Privado </x-components.label>
            <select @disabled($disabled) id="seguro_privado" name="seguro_privado"  @input="removeError($event)"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $disabled ? 'border-transparent font-normal' : '' }}">
                <option value="" selected>Seleccione</option>
                <option value="true" @selected(true === old('seguro_privado', $paciente['seguro_privado'] ?? ''))>Si</option>
                <option value="false" @selected(false === old('seguro_privado', $paciente['seguro_privado'] ?? ''))>No</option>
            </select>
        </div>
        <div class="p-2">
            <x-components.label for="discapacidad">Discapacidad </x-components.label>
            <select @disabled($disabled) id="discapacidad" name="discapacidad"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $disabled ? 'border-transparent font-normal' : '' }}">
                <option value="" selected>Seleccione</option>
                <option value="true" @selected(true === old('discapacidad', $paciente['discapacidad'] ?? ''))>Si</option>
                <option value="false" @selected(false === old('discapacidad', $paciente['discapacidad'] ?? ''))>No</option>
            </select>
        </div>

        <x-components.input-group type="number" name="porcentaje_discapacidad" label="Porcentaje de Discapacidad" placeholder="0" :disabled="$disabled" :value="old('porcentaje_discapacidad', isset($paciente['porcentaje_discapacidad']) ? $paciente['porcentaje_discapacidad'] : '0')" />

    </div>
</div>
