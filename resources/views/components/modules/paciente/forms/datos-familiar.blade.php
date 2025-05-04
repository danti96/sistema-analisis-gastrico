@props(['disabled' => false, 'paciente'=>[] ,'grupos_familiares'=>[], 'sexo'=>[], 'tipo_identificacion'=>[]])

<div class="bg-white my-2 border shadow-sm rounded-md">
    <div class="px-2 w-full py-2">
        <span class="text-gray-400 p-2">
            Detalle Del Familiar:
        </span>
    </div>
    <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full">

        <x-components.select-group-field id="familiares[parentesco]" label="Parentesco" :options="$grupos_familiares" :selected="old('parentesco', $paciente['parentesco'] ?? '')" :disabled="$disabled" />


        <x-components.input-group name="familiares[f_p_nombre]" label="Primer Nombre" placeholder="Primer Nombre" :disabled="$disabled" :value="old('f_p_nombre', isset($paciente['familiares']['f_p_nombre']) ? $paciente['familiares']['f_p_nombre'] : '')"  class="uppercase"/>
        <x-components.input-group name="familiares[f_s_nombre]" label="Segundo Nombre" placeholder="Segundo Nombre" :disabled="$disabled" :value="old('f_s_nombre', isset($paciente['familiares']['f_s_nombre']) ? $paciente['familiares']['f_s_nombre'] : '')"  class="uppercase"/>
        <x-components.input-group name="familiares[f_p_apellido]" label="Primer Apellido" placeholder="Primer Apellido" :disabled="$disabled" :value="old('f_p_apellido', isset($paciente['familiares']['f_p_apellido']) ? $paciente['familiares']['f_p_apellido'] : '')"  class="uppercase"/>
        <x-components.input-group name="familiares[f_s_apellido]" label="Segundo Apellido" placeholder="Segundo Apellido" :disabled="$disabled" :value="old('f_s_apellido', isset($paciente['familiares']['f_s_apellido']) ? $paciente['familiares']['f_s_apellido'] : '')"  class="uppercase"/>


        <x-components.input-group type="date" max="{{ date('Y-m-d') }}" name="familiares[fecha_nacimiento]" label="Fecha de Nacimiento" placeholder="Segundo Apellido" :disabled="$disabled" :value="old('fecha_nacimiento', isset($paciente['familiares']['fecha_nacimiento']) ? $paciente['familiares']['fecha_nacimiento'] : '')" />
        @if ($disabled)
            <x-components.input-group name="familiares[edad]" label="Edad" placeholder="0 años" :disabled="true" :value="old('edad', isset($paciente['familiares']['edad']) ? $paciente['familiares']['edad'] : '')" />
        @endif

        <x-components.select-field name="familiares[sexo]" label="Sexo" :options="$sexo" :selected="old('sexo', $paciente['familiares']['edad'] ?? '')" :disabled="$disabled" />
        <x-components.select-field name="familiares[tipo_identificacion]" label="Tipo Identificación" :options="$tipo_identificacion" :selected="old('tipo_identificacion', $paciente['tipo_identificacion'] ?? '')" :disabled="$disabled" />

        <x-components.input-group name="familiares[identificacion]" label="Identificación" placeholder="Identificación" :disabled="$disabled" :value="old('identificacion', isset($paciente['familiares']['identificacion']) ? $paciente['familiares']['identificacion'] : '')" />
        <x-components.input-group name="familiares[celular_1]" label="Celular 1" placeholder="0999999999" :disabled="$disabled" :value="old('celular_1', isset($paciente['familiares']['celular_1']) ? $paciente['familiares']['celular_1'] : '')" />
        <x-components.input-group name="familiares[celular_2]" label="Celular 2" placeholder="0999999999" :disabled="$disabled" :value="old('celular_2', isset($paciente['familiares']['celular_2']) ? $paciente['familiares']['celular_2'] : '')" />
        <x-components.input-group name="familiares[telefono]" label="telefono" placeholder="0999999999" :disabled="$disabled" :value="old('telefono', isset($paciente['familiares']['telefono']) ? $paciente['familiares']['telefono'] : '')" />

        <x-components.input-group name="familiares[ocupacion]" label="Ocupación" placeholder="Ocupación" :disabled="$disabled" :value="old('ocupacion', isset($paciente['familiares']['ocupacion']) ? $paciente['familiares']['ocupacion'] : '')" class="uppercase"/>
        <x-components.input-group name="familiares[direccion]" label="Dirección" placeholder="Dirección" :disabled="$disabled" :value="old('direccion', isset($paciente['familiares']['direccion']) ? $paciente['familiares']['direccion'] : '')" class="uppercase"/>

    </div>
</div>
