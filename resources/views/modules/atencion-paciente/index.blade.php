@section('title', 'Pacientes')

@push('scripts')
    <script>
        const componentPaciente = () => {
            return {
                table: { data: [], links: [], total: 0 },
                params: { limit: 10, search: '' },
                motivoconsulta: '',
                antecedentepersonales: '',
                antecedentefamiliares: '',
                imagenanalisis: null,
                resultImagenAnalisis:null,
                form: {
                    id: null,
                    apellidos: null,
                    nombres: null,
                    fecha_nacimiento: null,
                    estado_civil: null,
                    sexo: null,
                    tipo_identificacion: null,
                    identificacion: null,
                    correo: null,
                    celular: null,
                    direccion: null,
                    status: null,
                    created_at: null,
                    updated_at: null,
                    fullname: null,
                    edad: null,
                    meses: null,
                    dias: null,
                },
                pacienteSelect(d) {
                    this.form = d;
                    console.log(this.form)
                },
                init() {
                    this.paginate();
                },
                searchInput() {
                    this.paginate();
                },
                reset() {
                    this.params = {
                        limit: 10,
                        search: ''
                    };
                    this.paginate();
                },
                paginate() {
                    this.table = {
                        data: [],
                        links: [],
                        total: 0
                    };
                    const success = (e) => {
                        this.table = e?.data ?? [];
                        console.log('success', e);
                    }

                    const failed = (e) => {
                        console.error('error', e);
                    }

                    const route = `{{ route('paciente.paginate') }}`;

                    axios.get(route, {
                            params: this.params
                        })
                        .then(success)
                        .catch(failed);

                },
                fileChosen(event) {
                    if (!event.target.files.length) return;
                    console.log(event)
                    let reader = new FileReader();
                    reader.readAsDataURL(event.target.files[0]);
                    reader.onload = e => this.imagenanalisis = e.target.result;
                }
            }
        }
    </script>
@endpush

@push('modals')
    <x-alpinejs.modals.deshabilitar route="{{ route('paciente.destroy', ['id' => ':id']) }}" />
@endpush

<x-app-layout>
    <div class="p-4"
        x-data="componentPaciente()"
        @table-reload.window="paginate()"
        @select-opttion-paciente="pacienteSelect($event.detail)">
        <div class="bg-white shadow-sm rounded-md">

            <div class="border w-full p-2 rounded-md flex justify-between">
                <div class="p-2 w-full bg-blue-300 cursor-pointer">
                    <span class="font-bold underline decoration-solid text-md"> Pacientes </span>
                </div>
            </div>

            <div class="border w-full p-2 rounded-md flex justify-center">
                <div class="py-2 md:w-1/5">
                    <x-alpinejs.dropdown.search-paciente />
                </div>
            </div>

            <div class="border">

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4">

                    <x-components.input-group x-model="form.apellidos" name="apellidos" label="Apellidos"
                        disabled="disabled" placeholder="Apellidos" />

                    <x-components.input-group x-model="form.nombres" name="nombres" label="Nombres" disabled="disabled"
                        placeholder="Nombres" />

                    <x-components.input-group x-model="form.estado_civil" name="estado_civil" label="Estado Civil"
                        disabled="disabled" placeholder="Estado Civil" />

                    <x-components.input-group x-model="form.sexo" name="sexo" label="Sexo" disabled="disabled"
                        placeholder="Sexo" />

                    <x-components.input-group x-model="form.tipo_identificacion" name="tipo_identificacion"
                        disabled="disabled" label="Tipo Identificación" placeholder="Tipo Identificación" />

                    <x-components.input-group x-model="form.identificacion" name="identificacion" disabled="disabled"
                        label="Identificación" placeholder="Identificación" />

                    <x-components.input-group x-model="form.fecha_nacimiento" type="date" disabled="disabled"
                        max="{{ date('Y-m-d') }}" name="fecha_nacimiento" label="Fecha de Nacimiento"
                        placeholder="Fecha de Nacimiento" />

                    <x-components.input-group x-model="form.edad" name="edad" label="Edad" disabled="disabled"
                        placeholder="edad" />

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="p-2 col-span-1">
                        <label for="motivoconsulta"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motivo de
                            consulta</label>
                        <textarea id="motivoconsulta" rows="4" x-model="motivoconsulta"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Motivo de consulta"></textarea>
                    </div>

                    <div class="p-2 col-span-1">
                        <label for="antecedentepersonales"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Antecedentes
                            Personales</label>
                        <textarea id="antecedentepersonales" rows="4" x-model="antecedentepersonales"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Antecedentes Personales"></textarea>
                    </div>

                    <div class="p-2 col-span-1">
                        <label for="antecedentefamiliares"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Antecedentes
                            Familiares</label>
                        <textarea id="antecedentefamiliares" rows="4" x-model="antecedentefamiliares"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Antecedentes Familiares"></textarea>
                    </div>
                </div>

            </div>

            <div class="border">

                <div class="p-2 w-full">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Análisis Imagen
                    </label>
                </div>

                <div class="flex justify-start">
                    <div class="p-2">
                        <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 focus:outline-none">
                            <i class="fa-regular fa-floppy-disk"></i>
                            Analizar Imagen
                        </button>

                        <template x-if="imagenanalisis !== null">
                            <button type="button" @click="imagenanalisis=null"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 focus:outline-none">
                                <i class="fa-regular fa-floppy-disk"></i>
                                Remover Imagen
                            </button>
                        </template>
                    </div>
                </div>

                <div class="flex gap-2">
                    <template x-if="imagenanalisis == null">
                        <div class="p-2 w-1/4">
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:border-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                            800x400px)</p>
                                    </div>
                                    <input id="dropzone-file" type="file" class="hidden" accept="image/*" @change="fileChosen">
                                </label>
                            </div>
                        </div>
                    </template>

                    <div class="p-2 w-2/4">
                        <template x-if="imagenanalisis !== null">
                            <img class="h-auto max-w-lg rounded-lg" :src="imagenanalisis" alt="image description">
                        </template>
                    </div>
                </div>

            </div>
            <div class="border">

                <template x-if="resultImagenAnalisis !== null">
                    <div class="space-y-2">
                        <div class="p-2 w-full">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Indicadores de afectación
                            </label>
                        </div>
                        <div>
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Coincidencia</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="p-2 w-full">
                            <label for="procesamiento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Procesamiento</label>
                        </div>

                        <img src="" width="600" height="600" id="img-result-predictions" alt="Imagen obtenida">

                        <div class="p-2 col-span-1">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Resultados</label>
                            <textarea name="procesamiento_resultado" id="procesamiento_resultado" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500  focus:border-blue-500" placeholder="Procesamiento de resultados"></textarea>
                        </div>
                        <div class="p-2 col-span-1">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                % DE AFECTACIÓN
                            </label>
                            <textarea name="procesamiento_afectacion" id="procesamiento_afectacion" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Ant% Afectación"></textarea>
                        </div>
                    </div>
                </template>

            </div>
        </div>
    </div>

</x-app-layout>
