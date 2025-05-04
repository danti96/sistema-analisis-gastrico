<nav role="navigation" aria-label="Pagination Navigation"
    class="w-full flex items-center justify-center sm:pt-4">
    <div class="block sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-hsp-700 leading-5 p-4 text-center sm:p-2 sm:text-left">
                <span>Mostrando</span>
                <span class="font-medium" x-text="table.per_page"></span>
                <span>a</span>
                <span class="font-medium" x-text="table.to"></span>
                <span>de</span>
                <span class="font-medium" x-text="table.total"></span>
                <span>resultados</span>
            </p>
        </div>
        <div class="flex justify-center">
            <span class="relative z-0 inline-flex rounded-md shadow-sm">
                <span>
                    {{-- Previous Page Link --}}
                    <template x-if="table.prev_page_url == null">
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span
                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-none cursor-default rounded-l-md leading-5"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    </template>
                    <template x-if="table.prev_page_url !== null">
                        <button type="button" @click="paginate(table.first_page_url)"
                            rel="prev"
                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-none rounded-full leading-5 hover:text-hsp-500 hover:bg-gray-300 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 mr-1"
                            aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </template>
                </span>


                {{-- Pagination Elements --}}
                <template x-for="(item, idx) in table.links" :key="idx">
                    {{-- "Three Dots" Separator --}}
                    <template x-if="idx !== 0 && idx !== (table.links.length-1)">
                        <div>
                            <span>
                                <template x-if="item.active">
                                    <span aria-current="page">
                                        <span x-text="item.label"
                                            class="relative inline-flex items-center px-4 py-2 mr-1 -ml-px text-sm font-medium text-hsp-500 bg-gray-300 border border-gray-300 rounded-full cursor-default leading-5 select-none">
                                        </span>
                                    </span>
                                </template>
                                <template x-if="item.active==false">
                                    <button x-text="item.label" type="button"
                                        @click="paginate(item.url)"
                                        class="relative inline-flex items-center px-4 py-2 mr-1 -ml-px text-sm font-medium text-hsp-700 bg-white border border-none leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-hsp-700 transition ease-in-out duration-150">
                                    </button>
                                </template>
                            </span>
                        </div>
                    </template>
                </template>

                <span>
                    {{-- Next Page Link --}}
                    <template x-if="table.next_page_url == null">
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span
                                class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-none cursor-default rounded-full leading-5"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    </template>

                    <template x-if="table.next_page_url !== null">
                        <button type="button" @click="paginate(table.next_page_url)"
                            rel="next"
                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-none rounded-full leading-5 hover:text-hsp-500 hover:bg-gray-300 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                            aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </template>

                </span>
            </span>
        </div>
    </div>
</nav>
