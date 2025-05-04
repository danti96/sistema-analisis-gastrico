<div class="flex items-center gap-3">
    <span class="p-1 px-3 rounded-md bg-gray-300">
        <i class="fa-regular fa-{{ $icon }}"></i>
    </span>
    <span class="font-bold sm:text-base xl:text-xl" x-text="table.total">{{ $count }}</span>
    <span class="font-semibold text-base text-gray-400">{{ $label }}</span>
</div>
