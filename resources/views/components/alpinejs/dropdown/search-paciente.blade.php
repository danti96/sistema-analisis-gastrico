<div x-data="{
    route: `{{ route('paciente.paginate') }}`,
    data: [],
    loading: false,
    textSearch: null,
    timeout: null,
    search() {
        // Limpiar tiempo anterior si se vuelve a teclear
        this.data = [];
        if (this.timeout !== null) clearTimeout(this.timeout)

        // Espera 1 segundo antes de hacer la búsqueda
        this.timeout = setTimeout(() => {
            this.loading = true;
            axios.get(this.route, { params: { search: this.textSearch } })
                .then((response) => {
                    this.data = response.data?.data;
                    this.loading = false;
                })
                .catch((error) => {
                    console.error(error);
                    this.loading = false;
                });
        }, 1000);
    },
    selectOption(idx){
        $dispatch('select-opttion-paciente', this.data[idx]);
        document.getElementById('dropdownSearchButton').click();
    }
}" x-init="search()">
    <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch" data-dropdown-placement="bottom"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">Buscar Paciente
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="dropdownSearch" class="z-10 hidden bg-white rounded-lg shadow-sm w-96 dark:bg-gray-700">
        <div class="p-3">
            <label for="input-group-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="input-group-search" x-model="textSearch" @keyup="search()"
                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search user">
            </div>
        </div>
        <ul class="px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
            :class="{
                'h-48': data.length > 3,
                'h-10': loading && data.length === 0,
                'h-20': loading && data.length === 1,
                'h-30': loading && data.length === 2,
                'h-40': loading && data.length === 3
            }"
            aria-labelledby="dropdownSearchButton">
            <template x-for="(item, index) in data">
                <li @click="selectOption(index)">
                    <div class="flex items-center ps-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                        <label x-bind:for="`checkbox-item-${index}`"
                            x-text="`${item.identificacion} | ${item.fullname}`"
                            class="w-full py-2 ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">
                        </label>
                    </div>
                </li>
            </template>
        </ul>
    </div>

</div>
