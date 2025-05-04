@props(['id', 'label', 'disabled'=>false, 'selected', 'options'])
<div class="p-2">
    <x-components.label :for="$id">{{ $label }}</x-components.label>
    <select @disabled($disabled) id="{{ $id }}" name="{{ $id }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $disabled ? 'border-transparent font-normal' : '' }}">
        <option value="">Seleccione</option>
        @foreach ($options as $item)
            <optgroup label="{{ $item['valor'] }}">
                @foreach ($item['children'] as $children)
                    <option value="{{ $children['clave'] }}" @selected($selected == $children['clave'])>
                        {{ $children['valor'] }}
                    </option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
</div>
