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
                    this.table = { data: [], links: [], total: 0 };
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
            <div class="py-2 w-1/5">
                <x-components.custom.input.search x-model="params.search" />
            </div>
        </div>
        <div class="border">
            <div class="p-2 flex items-center gap-3 justify-between">
                <x-components.custom.section.stat-card icon="user" count="" label="Pacientes" />
                <div class="flex items-center">
                    <x-components.custom.button.create icon="user-circle" label="Paciente" buttonType="redirect"
                        href="{{ route('paciente.create') }}" />
                </div>
            </div>
            <div class="p-2 md:flex md:flex-col items-center gap-3 overflow-y-hidden overflow-x-auto">
                <x-alpinejs.table.table>
                    <x-slot name="caption">
                        <div class="flex justify-start gap-4 mb-2">
                            <x-alpinejs.table.number x-model="params.limit" @change="paginate()" />
                            <x-components.custom.button.actualizar @click="reset()" label="Actualizar" />
                        </div>
                    </x-slot>
                    <x-slot name="thead">
                        <x-alpinejs.table.th class="rounded-tl-md min-w-40">
                            <span>Nombre</span>
                        </x-alpinejs.table.th>
                        <x-alpinejs.table.th class="min-w-40">
                            <span>F. Nacimiento</span>
                        </x-alpinejs.table.th>
                        <x-alpinejs.table.th class="min-w-40">
                            <span>Identificacion</span>
                        </x-alpinejs.table.th>
                        <x-alpinejs.table.th class="min-w-60">
                            <span>Contacto</span>
                        </x-alpinejs.table.th>
                        <x-alpinejs.table.th class="min-w-40">
                            <span>Estado</span>
                        </x-alpinejs.table.th>
                        <x-alpinejs.table.th class="rounded-tr-md">
                            <span>Acciones</span>
                        </x-alpinejs.table.th>
                    </x-slot>
                    <x-slot name="tbody">
                        <template x-for="(item, index) in table.data" :key="index">
                            <tr class="hover:bg-gray-100 border-b">
                                <x-alpinejs.table.td>
                                    <a x-bind:href="`${ ('{{ route('paciente.show', ['id' => ':id']) }}').replace(':id', item.id)}`"
                                        target="_blank" rel="noopener noreferrer" class="hover:font-bold">
                                        <span x-text="item.fullname"></span>
                                    </a>
                                </x-alpinejs.table.td>
                                <x-alpinejs.table.td>
                                    <span x-text="item.fecha_nacimiento"></span>
                                </x-alpinejs.table.td>
                                <x-alpinejs.table.td>
                                    <span x-text="item.identificacion"></span>
                                </x-alpinejs.table.td>
                                <x-alpinejs.table.td>
                                    <div>
                                        <a x-bind:href="`telf: ${item.celular}`" class="flex gap-2 items-center">
                                            <i class="font-bold fa-solid fa-mobile-screen"></i>
                                            <span x-text="item.celular"></span>
                                        </a>
                                        <a x-bind:href="`mailto: ${item.correo}`"
                                            class="text-blue-500 flex gap-2 items-center">
                                            <i class="font-bold fa-regular fa-envelope"></i>
                                            <span x-text="item.correo"></span>
                                        </a>
                                    </div>
                                </x-alpinejs.table.td>
                                <x-alpinejs.table.td>
                                    <div class="justify-center flex">
                                        <span x-text="item.status==1?'Habilitado':'Deshabilitado'"
                                            class="border rounded-lg px-2 py-1 w-24"
                                            :class="item.status == 1 ? 'bg-green-500 text-white' : 'bg-red-500 text-white'"></span>
                                    </div>
                                </x-alpinejs.table.td>
                                <x-alpinejs.table.td>
                                    <x-alpinejs.table.options.dropdown>
                                        <x-slot name="slotDropdown">
                                            <x-alpinejs.table.options.option
                                                x-bind:href="`${ ('{{ route('paciente.edit', ['id' => ':id']) }}').replace(':id', item.id)}`">
                                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1"
                                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                </svg>
                                                <span>Editar</span>
                                            </x-alpinejs.table.options.option>
                                            <x-alpinejs.table.options.option
                                                @click="$dispatch('modal-deshabilitar', item);open=!open">
                                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1"
                                                        d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
                                                </svg>
                                                <span>Estado</span>
                                            </x-alpinejs.table.options.option>
                                            <x-alpinejs.table.options.option
                                                x-bind:href="`${ ('{{ route('paciente.show', ['id' => ':id']) }}').replace(':id', item.id)}`">
                                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1"
                                                        d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <span>Información</span>
                                            </x-alpinejs.table.options.option>
                                        </x-slot>
                                    </x-alpinejs.table.options.dropdown>
                                </x-alpinejs.table.td>
                            </tr>
                        </template>
                    </x-slot>
                </x-alpinejs.table.table>
                <x-alpinejs.table.paginate />
            </div>
        </div>
    </div>

</div>
</x-app-layout>
