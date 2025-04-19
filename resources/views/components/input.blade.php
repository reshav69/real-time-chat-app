@props(['type' => 'text', 'name', 'label' => '', 'value' => '', 'placeholder' => ''])

<div class="">
    @if($label)
        <label for="{{ $name }}" class="block text-m font-bold text-gray-200 mb-3">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'px-4 py-2 rounded-lg border border-gray-300 
                text-white placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-indigo-500 ,w-auto
                focus:border-indigo-500 transition duration-200']) }}
    >
    @error($name)
        <span class="text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>

{{-- mt-1 block w-full rounded-md border-gray-300 shadow-sm --}}