@props(['disabled' => false])

<input  @disabled($disabled)
    {!! $attributes->merge(['class' => 'w-full px-3 py-2 text-sm border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 dark:border-gray-600 dark:focus:ring-gray-700']) !!}>
