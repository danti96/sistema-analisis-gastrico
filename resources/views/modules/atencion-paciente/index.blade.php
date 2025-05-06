@section('title', 'Pacientes')

@push('scripts')
    <script>
        const componentPaciente = () => {
            return {
                table: {
                    data: [],
                    links: [],
                    total: 0
                },
                params: {
                    limit: 10,
                    search: ''
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

                }
            }
        }

        function dropdownSearch() {
            return {
                open: false,
                search: '',
                options: ['Ecuador', 'Colombia', 'Perú', 'Argentina', 'Chile', 'México', 'Venezuela'],
                filtered: [],
                filterOptions() {
                    this.filtered = this.options.filter(option =>
                        option.toLowerCase().includes(this.search.toLowerCase())
                    );
                },
                select(option) {
                    this.search = option;
                    this.open = false;
                },
            };
        }
    </script>
@endpush

@push('modals')
    <x-alpinejs.modals.deshabilitar route="{{ route('paciente.destroy', ['id' => ':id']) }}" />
@endpush

<x-app-layout>
    <div class="p-4">
        <div x-data="componentPaciente()" @table-reload.window="paginate()" class="bg-white shadow-sm rounded-md">
            <div class="border w-full p-2 rounded-md flex justify-between">
                <div class="p-2 w-full bg-blue-300 cursor-pointer">
                    <span class="font-bold underline decoration-solid text-md"> Pacientes </span>
                </div>
            </div>
            <div class="border w-full p-2 rounded-md flex justify-center">
                <div class="py-2 md:w-1/5">

                    <div x-data="dropdownSearch()" class="relative w-64">
                        <div class=" bg-gray-400 w-full h-full top-0 right-0 z-10" :class="open ? 'fixed' : 'hidden'"
                            @click="open=false"></div>
                        <input x-model="search" @focus="open = true" @input="filterOptions" type="text"
                            placeholder="Buscar..." class="w-full z-20 border p-2 rounded">

                        <ul x-show="open"
                            class="absolute z-10 mt-1 w-full max-h-40 overflow-y-auto bg-white border border-gray-300 rounded shadow">
                            <template x-for="option in filtered" :key="option">
                                <li @click="select(option)" class="p-2 hover:bg-blue-100 cursor-pointer"
                                    x-text="option"></li>
                            </template>
                            <li x-show="filtered.length === 0" class="p-2 text-gray-400">Sin resultados</li>
                        </ul>
                    </div>


                </div>
            </div>
            <div class="border">

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4">

                    <x-components.input-group x-model="form.apellidos" name="apellidos" label="Apellidos" disabled="disabled" placeholder="Apellidos"/>

                    <x-components.input-group x-model="" name="nombres" label="Nombres" disabled="disabled" placeholder="Nombres"/>

                    <x-components.input-group x-model="form.estado_civil" name="estado_civil" label="Estado Civil" disabled="disabled" placeholder="Estado Civil"/>

                    <x-components.input-group x-model="form.sexo" name="sexo" label="Sexo" disabled="disabled" placeholder="Sexo"/>

                    <x-components.input-group x-model="form.tipo_identificacion" name="tipo_identificacion" disabled="disabled" label="Tipo Identificación" placeholder="Tipo Identificación"/>

                    <x-components.input-group x-model="form.identificacion" name="identificacion" disabled="disabled" label="Identificación" placeholder="Identificación"/>

                    <x-components.input-group x-model="form.fecha_nacimiento" type="date" disabled="disabled" max="{{ date('Y-m-d') }}" name="fecha_nacimiento" label="Fecha de Nacimiento" placeholder="Fecha de Nacimiento"/>

                    <x-components.input-group x-model="form.edad" name="edad" label="Edad" disabled="disabled" placeholder="edad"/>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="p-2 col-span-1">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motivo de consulta</label>
                        <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                         placeholder="Motivo de consulta"></textarea>
                    </div>

                    <div class="p-2 col-span-1">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Antecedentes Personales</label>
                        <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                         placeholder="Antecedentes Personales"></textarea>
                    </div>

                    <div class="p-2 col-span-1">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Antecedentes Familiares</label>
                        <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                         placeholder="Antecedentes Familiares"></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
