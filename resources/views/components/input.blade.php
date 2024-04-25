@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-red-500 focus:border-red-800 focus:ring-red-800 rounded-md shadow-sm']) !!}>
