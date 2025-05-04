@props([
    'disabled' => false,
    'paciente' => [],
    'tipo_identificacion' => [],
    'grupos_familiares' => [],
    'nivel_educacion' => [],
    'estado_civil' => [],
    'sexo' => [],
])
<div>

    <div class="bg-white my-2 border shadow-sm rounded-md">
        <div class="px-2 w-full py-2">
            <span class="text-gray-400 p-2">
                Datos Personales
            </span>
        </div>
        <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full">

            <x-components.input-group name="p_nombre" label="Primer Nombre" placeholder="Primer Nombre" :disabled="$disabled" :value="old('p_nombre', isset($paciente['p_nombre']) ? $paciente['p_nombre'] : '')" class="uppercase" @input="removeError($event)" />
            <x-components.input-group name="s_nombre" label="Segundo Nombre" placeholder="Segundo Nombre" :disabled="$disabled" :value="old('s_nombre', isset($paciente['s_nombre']) ? $paciente['s_nombre'] : '')" class="uppercase"/>
            <x-components.input-group name="p_apellido" label="Primer Apellido" placeholder="Primer Apellido" :disabled="$disabled" :value="old('p_apellido', isset($paciente['p_apellido']) ? $paciente['p_apellido'] : '')" class="uppercase" @input="removeError($event)" />
            <x-components.input-group name="s_apellido" label="Segundo Apellido" placeholder="Segundo Apellido" :disabled="$disabled" :value="old('s_apellido', isset($paciente['s_apellido']) ? $paciente['s_apellido'] : '')" class="uppercase"/>

            <x-components.select-field name="estado_civil" label="Estado Civil" :options="$estado_civil" :selected="old('estado_civil', $paciente['estado_civil'] ?? '')" :disabled="$disabled"  @input="removeError($event)" />
            <x-components.select-field name="sexo" label="Sexo" :options="$sexo" :selected="old('sexo', $paciente['sexo'] ?? '')" :disabled="$disabled" @input="removeError($event)" />
            <x-components.select-field name="tipo_identificacion" label="Tipo Identificación" :options="$tipo_identificacion" :selected="old('tipo_identificacion', $paciente['tipo_identificacion'] ?? '')" :disabled="$disabled" @input="removeError($event)" />
            <x-components.input-group name="identificacion" label="Identificación" placeholder="Identificación" :disabled="$disabled" :value="old('identificacion', isset($paciente['identificacion']) ? $paciente['identificacion'] : '')" @input="removeError($event)" />

            <x-components.input-group name="correo" label="Correo" placeholder="example@dominio.com" :disabled="$disabled" :value="old('correo', isset($paciente['correo']) ? $paciente['correo'] : '')" />
            <x-components.input-group name="celular_1" label="Celular 1" placeholder="0999999999" :disabled="$disabled" :value="old('celular_1', isset($paciente['celular_1']) ? $paciente['celular_1'] : '')" />
            <x-components.input-group name="celular_2" label="Celular 2" placeholder="0999999999" :disabled="$disabled" :value="old('celular_2', isset($paciente['celular_2']) ? $paciente['celular_2'] : '')" />
            <x-components.input-group name="grupo_sanguineo" label="Grupo Sanguineo" placeholder="A+" :disabled="$disabled" :value="old('grupo_sanguineo', isset($paciente['grupo_sanguineo']) ? $paciente['grupo_sanguineo'] : '')" class="uppercase"/>

        </div>
    </div>

    <div class="bg-white my-2 border shadow-sm rounded-md">
        <div class="px-2 w-full py-2">
            <span class="text-gray-400 p-2">
                Datos de Residencia
            </span>
        </div>
        <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full">
            <x-components.input-group name="region" label="Región/Provincia" placeholder="Región/Provincia" :disabled="$disabled" :value="old('region', isset($paciente['region']) ? $paciente['region'] : '')" class="uppercase"/>
            <x-components.input-group name="ciudad" label="Ciudad" placeholder="Ciudad" :disabled="$disabled" :value="old('ciudad', isset($paciente['ciudad']) ? $paciente['ciudad'] : '')" class="uppercase"/>
            <x-components.input-group name="direccion" label="Dirección" placeholder="Dirección" :disabled="$disabled" :value="old('direccion', isset($paciente['direccion']) ? $paciente['direccion'] : '')" class="uppercase"/>
        </div>
    </div>


</div>
