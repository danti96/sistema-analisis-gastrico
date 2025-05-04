{{-- resources/views/components/input-group.blade.php --}}
@props(['name', 'label', 'value' => '', 'type' => 'text', 'disabled' => false, 'placeholder' => ''])
<div class="p-2">
    <x-components.label :for="$name">{{ $label }}</x-components.label>
    <x-components.input name="{{ $name }}" id="{{ $name }}" type="{{ $type }}" :value="$value"
        placeholder="{{ $disabled ? '' : $placeholder }}"
        :disabled='$disabled' {{ $attributes }} />
</div>
