<x-app-layout>
    <div x-data="{
        tab: 0,
        message: {status: 200, message: ''},
        enabledButton: true,
        submitted: false,
        required: {
            0: [
                'p_nombre',
                'p_apellido',
                'estado_civil',
                'sexo',
                'tipo_identificacion',
                'identificacion',
            ],
            3: [
                'nivel_educacion',
                'estado_nivel_educacion',
                'seguro_iess',
                'seguro_privado',
                'discapacidad',
            ]
        },
        formatData() {
            const data = {};
            const inputs = event.target.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                if (!input.name) return;
                // Detecta si es nombre tipo familiares[f_p_nombre]
                const match = input.name.match(/^([^\[]+)\[([^\]]+)\]$/);
                if (match) {
                    const parentKey = match[1]; // ejemplo: 'familiares'
                    const childKey = match[2]; // ejemplo: 'f_p_nombre'
                    // Asegura que data[parentKey] es un objeto
                    if (!data[parentKey]) {
                        data[parentKey] = {};
                    }
                    data[parentKey][childKey] = input.value;
                } else {
                    data[input.name] = input.value;
                }
            });
            return data;
        },
        validate(data) {
            this.submitted = true;
            for (const tab of Object.keys(this.required)) {
                const missingFields = this.required[tab].filter(key => !data[key] || data[key].trim() === '');
                if (missingFields.length > 0) {
                    // Marcar con borde rojo los inputs vacíos
                    focus = false;
                    missingFields.forEach(key => {
                        const input = document.getElementById(key);
                        if (input) {
                            if (!focus) {
                                input.focus();
                                focus = true;
                                this.tab = Number(tab);
                            }
                            input.classList.add('border-red-500');
                        }
                    });
                    return false;
                }
            }
            return true;
        },
        removeError(event) {
            if (!this.submitted) return;
            const input = event.target;
            if (input.value.trim() !== '') {
                input.classList.remove('border-red-500');
            }
        },
        store() {
            this.message.message = '';
            const data = this.formatData();

            if (!this.validate(data)) return;

            const success = (e) => {
                this.message.status = e?.status;
                this.message.message = 'Formulario enviado correctamente ✅';
                Toast.success(e?.data?.message);
                setTimeout(() => location.reload(), 5000);
            }

            const failed = (e) => {
                this.message.status = e?.response?.status;
                console.log(e?.response?.status)
                if (e.response?.data?.errors || e.response?.data?.message) {
                    // Puedes mostrar los errores específicos aquí
                        this.message.message = e.response?.data?.message;
                    Toast.warning(this.message.message);
                } else {
                    this.message = 'Error al enviar el formulario ❌';
                    Toast.warning(this.message);
                }
            }

            const route = `{{ route('paciente.update', ['paciente' => $id]) }}`;
            axios.put(route, data).then(success).catch(failed);
        }
    }" x-init="tab = 0">
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
                <template x-if="message.message!=''">
                    <div class="border w-full p-2 flex justify-between">
                        <div class="p-2 w-full cursor-pointer" :class="message.status == 200? 'bg-green-300':'bg-red-300'">
                            <span class="font-bold underline decoration-solid" x-text="message.message"></span>
                        </div>
                    </div>
                </template>
            </div>
            <div class="bg-white my-2 border shadow-sm rounded-md">
                <div class="px-2">
                    <button :class="tab == 0 ? 'bg-blue-400 font-semibold' : ''" @click="tab=0" type="button"
                        class="p-2 bg-blue-300 rounded-t-md hover:bg-blue-400 hover:font-semibold">
                        Datos Personales</button>
                    <button :class="tab == 1 ? 'bg-blue-400 font-semibold' : ''" @click="tab=1" type="button"
                        class="p-2 bg-blue-300 rounded-t-md hover:bg-blue-400 hover:font-semibold">
                        Datos Nacimiento</button>
                    <button :class="tab == 2 ? 'bg-blue-400 font-semibold' : ''" @click="tab=2" type="button"
                        class="p-2 bg-blue-300 rounded-t-md hover:bg-blue-400 hover:font-semibold">
                        Datos Familiares</button>
                    <button :class="tab == 3 ? 'bg-blue-400 font-semibold' : ''" @click="tab=3" type="button"
                        class="p-2 bg-blue-300 rounded-t-md hover:bg-blue-400 hover:font-semibold">
                        Datos Adicionales</button>
                </div>
            </div>
            <div class="max-h-full p-2 border rounded-md w-full">
                <div x-show="tab === 0">
                    <x-modules.paciente.forms.datos-personales :paciente="$paciente" :disabled="false"
                        :tipo_identificacion="$tipo_identificacion" :grupos_familiares="$grupos_familiares" :nivel_educacion="$nivel_educacion" :estado_civil="$estado_civil" :sexo="$sexo" />
                </div>
                <div x-show="tab === 1">
                    <x-modules.paciente.forms.datos-nacimientos :paciente="$paciente" :disabled="false"
                        :countries='$countries' />
                </div>
                <div x-show="tab === 2">
                    <x-modules.paciente.forms.datos-familiar :paciente="$paciente" :disabled="false"
                        :tipo_identificacion="$tipo_identificacion" :grupos_familiares="$grupos_familiares" :sexo="$sexo" />
                </div>
                <div x-show="tab === 3">
                    <x-modules.paciente.forms.datos-adicionales :paciente="$paciente" :disabled="false"
                        :nivel_educacion="$nivel_educacion" :estado_nivel_educacion="$estado_nivel_educacion" />
                </div>
            </div>

        </form>
    </div>
</x-app-layout>
