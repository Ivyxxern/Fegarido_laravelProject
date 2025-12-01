@props(['title', 'value', 'color' => 'blue'])

<div class="p-4 rounded-lg border bg-white dark:bg-neutral-900 shadow-sm">
    <div class="text-sm font-medium text-neutral-600 dark:text-neutral-300">
        {{ $title }}
    </div>

    <div class="mt-2 text-2xl font-bold text-{{ $color }}-600">
        {!! $value !!}
    </div>
</div>
