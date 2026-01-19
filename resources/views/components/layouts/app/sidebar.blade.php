<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')" class="grid">
                <flux:navlist.item icon="home"
                    :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')"
                    wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navlist.item>

                <flux:navlist.item icon="tag"
                    :href="route('bike-categories.index')"
                    :current="request()->routeIs('bike-categories.*')"
                    wire:navigate>
                    {{ __('Bike Categories') }}
                </flux:navlist.item>

                <flux:navlist.item icon="trash"
                    :href="route('trash')"
                    :current="request()->routeIs('trash')"
                    wire:navigate>
                    {{ __('Trash') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- User Profile Section --}}
        <div class="mt-auto border-t border-zinc-200 dark:border-zinc-700 p-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 text-white text-xs font-semibold">
                    {{ auth()->user()->initials() }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100 truncate">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center px-4 py-2 text-sm text-red-500 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-md">
                    Logout
                </button>
            </form>
        </div>
    </flux:sidebar>

    {{ $slot }}

    @fluxScripts
</body>
</html>
