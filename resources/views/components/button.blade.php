@props([
    'text' => '',
    'isDisabled' => 'false',
])

<div class="flex w-full mt-8">
    <button
        class="w-full {{ $isDisabled == 'false' ? 'bg-teal-600 hover:bg-teal-700' : 'bg-slate-500 hover:bg-slate-500' }} text-white text-sm py-2 px-4 font-semibold rounded focus:outline-none focus:shadow-outline h-10 transition duration-150"
        id="btn" type="submit" {{ $isDisabled == 'false' ? '' : 'disabled' }}>
        {{ $text }}
    </button>
</div>
