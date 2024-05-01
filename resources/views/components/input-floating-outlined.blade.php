<!-- InputFloatingOutlined.blade.php -->

@props(['name', 'label', 'value', 'has_errors' => false, 'required' => false])

<div class="relative">
    <input type="text" id="{{ $name }}"
        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 {{ $has_errors ? ' border-red-500 ' : 'border-gray-300 ' }} appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary focus:outline-none focus:ring-0 focus:border-primary peer"
        placeholder="" name="{{ $name }}" value="{{ $value }}" />
    <label for="{{ $name }}"
        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-100 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-gray-900 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

</div>
@if ($hasErrors)
    <p class="text-red-500 text-xs mt-1">{{ $errors->first($name) }}</p>
@endif
