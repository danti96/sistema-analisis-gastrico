@push('scripts')
    <script>
        const componentCreatePaciente = () => {
            return {
                message: {
                    status: null,
                    message: ''
                },
                enabledButton: true,
                submitted: false,
                form: {
                    apellidos: '',
                    nombres: '',
                    estado_civil: '',
                    sexo: '',
                    tipo_identificacion: '',
                    identificacion: '',
                    correo: '',
                    celular: '',
                    region: '',
                    ciudad: '',
                    direccion: '',
                    fecha_nacimiento: '',
                },
                removeError(event) {
                    if (!this.submitted) return;
                    const input = event.target;
                    if (input.value.trim() !== '') {
                        input.classList.remove('border-red-500');
                    }
                },
                formDataIsEmpty() {
                    return Object.values(this.form).filter((r) => r === '').length > 0;
                },
                store() {
                    this.submitted = true;
                    this.message = {
                        status: null,
                        message: ''
                    };

                    if (this.formDataIsEmpty()) return;

                    const success = (e) => {
                        Toast.success('A toast without a title also works');
                        this.message = {status: e?.status, message: 'Formulario enviado correctamente ✅'};
                        setTimeout(() => location.reload(), 5000);
                    }

                    const failed = (e) => {
                        if (e.response?.data?.errors || e.response?.data?.message) {
                            // Puedes mostrar los errores específicos aquí
                            this.message = { status: 500, message: e.response?.data?.message };
                            Toast.warning(this.message.message);
                        } else {
                            this.message = { status: 400, message: 'Error al enviar el formulario ❌' };
                            Toast.warning(this.message.message);
                        }
                    }

                    const route = `{{ route('paciente.store') }}`;
                    axios.post(route, this.form).then(success).catch(failed);
                }
            };
        }
    </script>
@endpush
<x-app-layout>
    <div x-data="componentCreatePaciente()">
        <form action="" method="post" @submit.prevent="store">
            @csrf
            <div class="bg-white shadow-sm rounded-md">
                <div class="border w-full p-2 flex justify-between">
                    <div class="p-2 w-full bg-blue-300 cursor-pointer">
                        <span class="font-bold underline decoration-solid"> Registro De Paciente </span>
                    </div>
                </div>
                <div class="border w-full p-2 flex justify-start">

                    <a type="button" href="{{ route('paciente.index') }}"
                        class="py-1 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <i class="fa-solid fa-arrow-left"></i>
                        Volver
                    </a>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <i class="fa-regular fa-floppy-disk"></i>
                        Guardar
                    </button>
                </div>

                <x-alpinejs.banner.message/>

            </div>
            <div class="bg-white my-2 border shadow-sm rounded-md">

                <div class="max-h-full p-2 border rounded-md w-full">
                    <div class="bg-white my-2 border shadow-sm rounded-md">
                        <div class="px-2 w-full py-2">
                            <span class="text-gray-400 p-2">
                                <i class="fa-light fa-house"></i>
                                Datos Personales
                            </span>
                        </div>
                        <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full">

                            <x-components.input-group x-model="form.apellidos" name="apellidos" label="Apellidos"
                                placeholder="Apellidos" @input="removeError($event)"
                                x-bind:class="{ 'border-red-500': submitted && !form.apellidos }" />

                            <x-components.input-group x-model="form.nombres" name="nombres" label="Nombres"
                                placeholder="Nombres" @input="removeError($event)"
                                x-bind:class="{ 'border-red-500': submitted && !form.nombres }" />


                            <x-components.select-field x-model="form.estado_civil" name="estado_civil"
                                label="Estado Civil" @input="removeError($event)"
                                x-bind:class="{ 'border-red-500': submitted && !form.estado_civil }">
                                <option value="Soltero/a" @selected(old('estado_civil', $paciente['estado_civil'] ?? '') == 'Soltero/a')>Soltero/a</option>
                                <option value="Casado/a" @selected(old('estado_civil', $paciente['estado_civil'] ?? '') == 'Casado/a')>Casado/a</option>
                                <option value="Divorciado/a" @selected(old('estado_civil', $paciente['estado_civil'] ?? '') == 'Divorciado/a')>Divorciado/a</option>
                                <option value="Union Libre" @selected(old('estado_civil', $paciente['estado_civil'] ?? '') == 'Union Libre')>Union Libre</option>
                                <option value="Otros" @selected(old('estado_civil', $paciente['estado_civil'] ?? '') == 'Otros')>Otros</option>
                            </x-components.select-field>

                            <x-components.select-field x-model="form.sexo" name="sexo" label="Sexo"
                                @input="removeError($event)"
                                x-bind:class="{ 'border-red-500': submitted && !form.sexo }">
                                <option value="Hombre" @selected(old('sexo', $paciente['sexo'] ?? '') == 'Hombre')>Hombre</option>
                                <option value="Mujer" @selected(old('sexo', $paciente['sexo'] ?? '') == 'Mujer')>Mujer</option>
                                <option value="Otros" @selected(old('sexo', $paciente['sexo'] ?? '') == 'Otros')>Otros</option>
                            </x-components.select-field>

                            <x-components.select-field x-model="form.tipo_identificacion" name="tipo_identificacion"
                                label="Tipo Identificación" @input="removeError($event)"
                                x-bind:class="{ 'border-red-500': submitted && !form.tipo_identificacion }">
                                <option value="Cédula" @selected(old('tipo_identificacion', $paciente['tipo_identificacion'] ?? '') === 'Cédula')>Cédula</option>
                                <option value="Ruc" @selected(old('tipo_identificacion', $paciente['tipo_identificacion'] ?? '') === 'Ruc')>Ruc</option>
                                <option value="Pasaporte" @selected(old('tipo_identificacion', $paciente['tipo_identificacion'] ?? '') === 'Pasaporte')>Pasaporte</option>
                            </x-components.select-field>

                            <x-components.input-group x-model="form.identificacion" name="identificacion"
                                label="Identificación" placeholder="Identificación" @input="removeError($event)"
                                x-bind:class="{ 'border-red-500': submitted && !form.identificacion }" />

                            <x-components.input-group x-model="form.correo" name="correo" label="Correo"
                                placeholder="example@dominio.com" @input="removeError($event)"
                                x-bind:class="{ 'border-red-500': submitted && !form.correo }" />

                            <x-components.input-group x-model="form.celular" name="celular" label="Celular"
                                placeholder="09 #### ####" @input="removeError($event)"
                                x-bind:class="{ 'border-red-500': submitted && !form.celular }" />

                        </div>
                    </div>

                    <div class="bg-white my-2 border shadow-sm rounded-md">
                        <div class="px-2 w-full py-2">
                            <span class="text-gray-400 p-2">
                                Datos de Residencia
                            </span>
                        </div>
                        <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full">
                            <x-components.input-group x-model="form.region" name="region" label="Región/Provincia"
                                placeholder="Región/Provincia" @input="removeError($event)"
                                x-bind:class="{ 'border-red-500': submitted && !form.region }" />

                            <x-components.input-group x-model="form.ciudad" name="ciudad" label="Ciudad"
                                placeholder="Ciudad" @input="removeError($event)"
                                x-bind:class="{ 'border-red-500': submitted && !form.ciudad }" />

                            <x-components.input-group x-model="form.direccion" name="direccion" label="Dirección"
                                placeholder="Dirección" @input="removeError($event)"
                                x-bind:class="{ 'border-red-500': submitted && !form.direccion }" />
                        </div>
                    </div>


                    <div class="bg-white my-2 border shadow-sm rounded-md">
                        <div class="px-2 w-full py-2">
                            <span class="text-gray-400 p-2">
                                Datos de Nacimiento
                            </span>
                        </div>
                        <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full">
                            <x-components.input-group x-model="form.fecha_nacimiento" type="date"
                                max="{{ date('Y-m-d') }}" name="fecha_nacimiento" label="Fecha de Nacimiento"
                                placeholder="Fecha de Nacimiento" @input="removeError($event)"
                                x-bind:class="{ 'border-red-500': submitted && !form.fecha_nacimiento }" />
                        </div>
                    </div>


                </div>
            </div>

        </form>
    </div>
</x-app-layout>
