
<div x-data="{open:false}" class="relative">

    <div @click="open=false"
        x-show="open"
        x-on:close.stop="open = false"
        x-on:keydown.escape.window="open = false"
        x-cloak
        x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        :class="open ? 'fixed inset-0 transition-opacity bg-gray-50 bg-opacity-40' : 'hidden'"
        class=""></div>

    <button @click="open=!open"
        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100
        focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
        type="button">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
            <path
                d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div x-show="open"
        class="z-10 absolute right-0 top-0 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
            {{ $slotDropdown }}
        </ul>
        @isset($slotSeparated)
            <div class="py-2">
                {{ $slotSeparated ?? '' }}
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                    Separated link
                </a>
            </div>
        @endisset
    </div>
</div>
