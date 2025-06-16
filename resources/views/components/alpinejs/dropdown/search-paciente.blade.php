<div x-data="{
    route: `{{ route('paciente.paginate') }}`,
    data: [],
    loading: false,
    textSearch: null,
    timeout: null,
    search() {
        // Limpiar tiempo anterior si se vuelve a teclear
        this.data = [];
        this.loading = true;
        if (this.timeout !== null) clearTimeout(this.timeout)

        // Espera 1 segundo antes de hacer la búsqueda
        this.timeout = setTimeout(() => {
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
    reset(){
        document.getElementById('dropdownSearchButton').click();
        this.textSearch='';
        this.search();
    },
    selectOption(idx) {
        $dispatch('select-opttion-paciente', this.data[idx]);
        document.getElementById('dropdownSearchButton').click();
    }
}" x-init="search()"
    x-on:keydown.escape.window="reset()"
>
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
            <template x-if="data.length == 0 && !loading">
                 <li>
                    <div class="flex items-center ps-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                        <label @click="reset()"
                            class="w-full py-2 ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">
                            Paciente no encontrado
                        </label>
                    </div>
                </li>
            </template>
            <template x-if="data.length == 0 && loading">
                <div role="status" class="flex justify-center">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </template>
        </ul>
    </div>

</div>
