@props([
    'label' => '',
    'color' => '',
    'href' => '',
    'active' => '',
    'icon' => '',
])

<li class="mr-6 my-2 md:my-0">
    <a href="{{ $href }}"
        class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-gray-100 border-b-2 {{ Request::is($active) ? 'border-' . $color . ' text-' . $color : 'border-gray-900 text-gray-500' }} hover:border-{{ $color }}">
        <i class="{{ $icon }} mr-3"></i><span class="pb-1 md:pb-0 text-sm">{{ $label }}</span>
    </a>
</li>
