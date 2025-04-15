@props(['type' => 'text', 'name', 'label' => '', 'value' => '', 'placeholder' => ''])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-m font-bold text-gray-200 mb-3">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'shadow appearance-none border rounded
         w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline']) }}
    >
    @error($name)
        <span class="text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>

{{-- mt-1 block w-full rounded-md border-gray-300 shadow-sm --}}