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

                <flux:navlist.item
                    :href="route('bikes.index')"
                    :current="request()->routeIs('bikes.index')"
                    wire:navigate>
                    {{ __('Bikes') }}
                </flux:navlist.item>

                <flux:navlist.item icon="tag"
                    :href="route('brands.index')"
                    :current="request()->routeIs('brands.index')"
                    wire:navigate>
                    {{ __('Brands') }}
                </flux:navlist.item>
            </flux:navlist.group>

            <flux:menu.separator />

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full flex items-center px-4 py-2 text-left text-sm text-red-500 hover:bg-red-100 dark:hover:bg-red-900/30">
                    <span class="flex-1">Logout</span>
                </button>
            </form>
        </flux:navlist>
    </flux:sidebar>

    {{ $slot }}

    @fluxScripts
</body>
</html>

