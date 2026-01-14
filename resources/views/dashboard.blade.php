<x-layouts.app :title="__('Dashboard')">
<div class="flex h-full w-full flex-col gap-4">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="rounded-md bg-green-900/30 px-4 py-2 text-sm text-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Stats --}}
    <div class="grid gap-4 md:grid-cols-3">

        {{-- Total Customers --}}
        <div class="flex items-center gap-3 rounded-lg border border-neutral-700 bg-neutral-800 px-4 py-3">
            <div>
                <p class="text-xs text-neutral-400">Total Customers</p>
                <p class="mt-1 text-2xl font-semibold text-white">
                    {{ $customers->count() }}
                </p>
            </div>
        </div>

        {{-- Available Bikes --}}
        <div class="flex items-center gap-3 rounded-lg border border-neutral-700 bg-neutral-800 px-4 py-3">
            <div>
                <p class="text-xs text-neutral-400">Available Bikes</p>
                <p class="mt-1 text-2xl font-semibold text-white">
                    {{ $bikes->where('is_rented', false)->count() }}
                </p>
            </div>
        </div>

        {{-- Status --}}
        <div class="flex items-center gap-3 rounded-lg border border-neutral-700 bg-neutral-800 px-4 py-3">
            <div>
                <p class="text-xs text-neutral-400">Status</p>
                <p class="mt-1 text-2xl font-semibold text-green-500">OPEN</p>
            </div>
        </div>
    </div>

    {{-- Add Customer --}}
    <div class="rounded-lg border border-neutral-700 bg-neutral-800 px-4 py-4">
        <h2 class="mb-4 text-sm font-semibold text-white">Add New Customer</h2>

        <form method="POST" action="{{ route('bikes.store') }}" class="grid gap-4 md:grid-cols-2">
            @csrf
            <x-input name="customer_name" label="Customer Name" />
            <x-input name="bike_name" label="Bike Name" />
            <x-input name="phone" label="Phone" />
            <x-input name="address" label="Address" />
            <div class="md:col-span-2">
                <button class="rounded-md bg-blue-600 px-4 py-2 text-xs font-medium text-white hover:bg-blue-700">
                    Add Customer
                </button>
            </div>
        </form>

        {{-- Customer List --}}
        <h2 class="mt-6 mb-2 text-sm font-semibold text-white">Customer List</h2>
        <table class="w-full text-xs">
            <thead class="border-b border-neutral-700 text-neutral-400">
                <tr>
                    <th class="px-2 py-1">#</th>
                    <th class="px-2 py-1">Customer</th>
                    <th class="px-2 py-1">Bike</th>
                    <th class="px-2 py-1">Phone</th>
                    <th class="px-2 py-1">Address</th>
                    <th class="px-2 py-1">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr class="border-b border-neutral-700 text-white">
                    <td class="px-2 py-1.5">{{ $loop->iteration }}</td>
                    <td class="px-2 py-1.5">{{ $customer->customer_name }}</td>
                    <td class="px-2 py-1.5">{{ $customer->bike_name }}</td>
                    <td class="px-2 py-1.5">{{ $customer->phone }}</td>
                    <td class="px-2 py-1.5">{{ $customer->address }}</td>
                    <td class="px-2 py-1.5 flex gap-1">

                        <button onclick="document.getElementById('edit-customer-{{ $customer->id }}').classList.remove('hidden')"
                            class="rounded bg-yellow-500 px-2 py-0.5 text-[11px] text-black">
                            Edit
                        </button>

                        <form method="POST" action="{{ route('bikes.destroy', $customer) }}"
                              onsubmit="return confirm('Do you wanna delete this?')">
                            @csrf
                            @method('DELETE')
                            <button class="rounded bg-red-600 px-2 py-0.5 text-[11px] text-white">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- Edit Customer --}}
                <tr id="edit-customer-{{ $customer->id }}" class="hidden bg-neutral-900">
                    <td colspan="6" class="px-2 py-2">
                        <form method="POST" action="{{ route('bikes.update', $customer) }}" class="grid gap-2 md:grid-cols-4">
                            @csrf
                            @method('PUT')
                            <input name="customer_name" value="{{ $customer->customer_name }}" class="input">
                            <input name="bike_name" value="{{ $customer->bike_name }}" class="input">
                            <input name="phone" value="{{ $customer->phone }}" class="input">
                            <input name="address" value="{{ $customer->address }}" class="input">
                            <div class="md:col-span-4 flex gap-2">
                                <button class="rounded bg-blue-600 px-3 py-1 text-xs text-white">Save</button>
                                <button type="button"
                                    onclick="document.getElementById('edit-customer-{{ $customer->id }}').classList.add('hidden')"
                                    class="rounded bg-neutral-600 px-3 py-1 text-xs text-white">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Bike List --}}
        <h2 class="mt-6 mb-2 text-sm font-semibold text-white">List of Bikes</h2>
        <table class="w-full text-xs">
            <thead class="border-b border-neutral-700 text-neutral-400">
                <tr>
                    <th class="px-2 py-1">#</th>
                    <th class="px-2 py-1">Bike</th>
                    <th class="px-2 py-1">Status</th>
                    <th class="px-2 py-1">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bikes as $bike)
                <tr class="border-b border-neutral-700 text-white">
                    <td class="px-2 py-1.5">{{ $loop->iteration }}</td>
                    <td class="px-2 py-1.5">{{ $bike->bike_name }}</td>
                    <td class="px-2 py-1.5">
                        <span class="rounded px-2 py-0.5 text-[11px]
                            {{ $bike->is_rented ? 'bg-red-600' : 'bg-green-600' }}">
                            {{ $bike->is_rented ? 'Unavailable' : 'Available' }}
                        </span>
                    </td>
                    <td class="px-2 py-1.5 flex gap-1">

                        <button onclick="document.getElementById('edit-bike-{{ $bike->id }}').classList.remove('hidden')"
                            class="rounded bg-yellow-500 px-2 py-0.5 text-[11px] text-black">
                            Edit
                        </button>

                        <form method="POST" action="{{ route('bikes.destroy', $bike) }}"
                              onsubmit="return confirm('Do you wanna delete this?')">
                            @csrf
                            @method('DELETE')
                            <button class="rounded bg-red-600 px-2 py-0.5 text-[11px] text-white">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- Edit Bike --}}
                <tr id="edit-bike-{{ $bike->id }}" class="hidden bg-neutral-900">
                    <td colspan="4" class="px-2 py-2">
                        <form method="POST" action="{{ route('bikes.update', $bike) }}" class="grid gap-2 md:grid-cols-3">
                            @csrf
                            @method('PUT')
                            <input name="bike_name" value="{{ $bike->bike_name }}" class="input">
                            <select name="is_rented" class="input">
                                <option value="0" {{ !$bike->is_rented ? 'selected' : '' }}>Available</option>
                                <option value="1" {{ $bike->is_rented ? 'selected' : '' }}>Unavailable</option>
                            </select>
                            <div class="flex gap-2">
                                <button class="rounded bg-blue-600 px-3 py-1 text-xs text-white">Save</button>
                                <button type="button"
                                    onclick="document.getElementById('edit-bike-{{ $bike->id }}').classList.add('hidden')"
                                    class="rounded bg-neutral-600 px-3 py-1 text-xs text-white">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-layouts.app>
