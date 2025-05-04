<li>
    <a
        {{ $attributes->merge(['class' => 'text-sm block px-4 py-2 hover:bg-gray-100 cursor-pointer w-full flex items-center font-medium gap-2 dark:hover:bg-gray-600 dark:hover:text-white']) }}>
        {{ $slot }}
    </a>
</li>
