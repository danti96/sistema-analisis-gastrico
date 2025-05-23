@props(['name', 'label', 'disabled' => false])
<div class="p-2">
    <x-components.label :for="$name">{{ $label }}</x-components.label>
    <select @disabled($disabled) id="{{ $name }}" name="{{ $name }}" {{ $attributes }}
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $disabled ? 'border-transparent font-normal' : '' }}">
        <option value="">Seleccione</option>
        {{ $slot }}
    </select>
</div>
