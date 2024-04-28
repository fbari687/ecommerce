@props([
    'label' => '',
    'placeholder' => '',
    'id' => '',
    'name' => '',
    'type' => '',
])

<div class="mb-4 mt-6">
    <label class="block text-sm font-semibold mb-2" for="{{ $id }}">
        {{ $label }}
    </label>
    <input
        class="text-sm appearance-none rounded w-full py-2 px-3 bg-[#1F2937] leading-tight focus:outline-none focus:shadow-outline h-10"
        id="{{ $id }}" type="{{ $type }}" placeholder="{{ $placeholder }}" name="{{ $name }}" />
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
