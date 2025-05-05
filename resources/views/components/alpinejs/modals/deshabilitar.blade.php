@props(['route'])
<div x-data="{
    open: false,
    disabled: false,
    item: {},
    openModal(d){
        this.item = d;
        this.open = true;
    },
    remove(idx) {
        this.disabled = true;
        const success = (e) => {
            this.disabled = false;
            this.open = false;
            //Toast.success(message);
            $dispatch('table-reload')
        }
        const failed = (e) => {
            this.disabled = false;
            this.open = false;
            //Toast.warning(message, null, 3000);
        }
        const route = `{{ $route }}`;
        console.log(route, this.item.id)
        axios.delete(route.replace(':id', this.item.id)).then(success).catch(failed);
    }
}"
@modal-deshabilitar.window="openModal($event.detail)"
x-on:keydown.escape.prevent.stop="open = false">
    <template x-if="open==true">
        <div tabindex="-1" :class="open ? 'fixed' : 'hidden'"
            class="top-0 left-0 right-0 z-[60] p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex items-center justify-center">
            <div x-show="open" x-transition.opacity="" @click="open=!this.open"
                class="fixed inset-0 bg-black bg-opacity-50" aria-hidden="true"></div>
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" @click="open=!this.open"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            ¿Está seguro que desea deshabilitar este registro?
                        </h3>
                        <button type="button" @click="remove()" :disabled="disabled"
                            class="inline-flex items-center px-4 py-2 font-medium text-xs leading-tight rounded shadow-md hover:shadow-lg
                            active:shadow-lg transition duration-150 only:ease-in-out bg-blue-500 border border-blue-500 text-white tracking-widest hover:bg-blue-700 hover:text-white-500
                            active:text-blue-800 active:bg-blue-800
                             disabled:bg-gray-300 disabled:text-gray-900 disabled:border-gray-400 disabled:shadow-none disabled:cursor-not-allowed">
                            Si, seguro
                        </button>
                        <button type="button"  @click="open=!this.open"
                            class="inline-flex items-center px-4 py-2 font-medium text-xs leading-tight rounded shadow-md hover:shadow-lg
                            active:shadow-lg transition duration-150 only:ease-in-out bg-red-500 border border-red-500 text-white tracking-widest hover:bg-red-700 hover:text-white-500
                            active:text-red-800 active:bg-red-800
                             disabled:bg-gray-300 disabled:text-gray-900 disabled:border-gray-400 disabled:shadow-none disabled:cursor-not-allowed">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
