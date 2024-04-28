@props([
    'value' => '',
    'title' => '',
])

<li>
    <input type="radio" id="{{ $value }}" name="role" value="{{ $value }}" class="hidden peer" required />
    <label for="{{ $value }}"
        class="flex items-center justify-center w-full py-2 text-gray-500 bg-gray-800 border border-gray-700 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
        <div class="block">
            <div class="w-full">{{ $title }}</div>
        </div>
    </label>
</li>
