<x-layouts.app :title="__('Dashboard')">
<div class="flex h-full w-full flex-col gap-6 p-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Bike Rental Dashboard</h1>
            <p class="text-sm text-neutral-400 mt-1">Manage your bike rental inventory</p>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="rounded-lg bg-gradient-to-r from-green-900/40 to-green-800/40 border border-green-700/50 px-4 py-3 text-sm text-green-200 flex items-center gap-2 shadow-lg animate-fade-in">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="rounded-lg bg-gradient-to-r from-red-900/40 to-red-800/40 border border-red-700/50 px-4 py-3 text-sm text-red-200">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Statistics Cards --}}
    <div class="grid gap-6 md:grid-cols-3">
        {{-- Total Bikes --}}
        <div class="group relative overflow-hidden rounded-xl border border-neutral-700/50 bg-gradient-to-br from-neutral-800 to-neutral-900 p-6 shadow-lg transition-all duration-300 hover:border-blue-500/50 hover:shadow-xl hover:shadow-blue-500/10">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-blue-500/10 blur-2xl"></div>
            <div class="relative flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-neutral-400">Total Bikes</p>
                    <p class="mt-1 text-3xl font-bold text-white">{{ $totalBikes }}</p>
                </div>
            </div>
        </div>

        {{-- Available Bikes --}}
        <div class="group relative overflow-hidden rounded-xl border border-neutral-700/50 bg-gradient-to-br from-neutral-800 to-neutral-900 p-6 shadow-lg transition-all duration-300 hover:border-green-500/50 hover:shadow-xl hover:shadow-green-500/10">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-green-500/10 blur-2xl"></div>
            <div class="relative flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-br from-green-500 to-green-600 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-neutral-400">Available Bikes</p>
                    <p class="mt-1 text-3xl font-bold text-white">{{ $availableBikes }}</p>
                </div>
            </div>
        </div>

        {{-- Status --}}
        <div class="group relative overflow-hidden rounded-xl border border-neutral-700/50 bg-gradient-to-br from-neutral-800 to-neutral-900 p-6 shadow-lg transition-all duration-300 hover:border-purple-500/50 hover:shadow-xl hover:shadow-purple-500/10">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-purple-500/10 blur-2xl"></div>
            <div class="relative flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-br from-purple-500 to-purple-600 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-neutral-400">Status</p>
                    <p class="mt-1 text-3xl font-bold text-green-400">OPEN</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Add New Bike Form --}}
    <div class="rounded-xl border border-neutral-700/50 bg-gradient-to-br from-neutral-800 to-neutral-900 p-6 shadow-lg">
        <div class="mb-6 flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-blue-600">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-white">Add New Bike</h2>
                <p class="text-xs text-neutral-400">Enter bike details below</p>
            </div>
        </div>

        <form method="POST" action="{{ route('bikes.store') }}" class="grid gap-4 md:grid-cols-2">
            @csrf
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">
                    Bike Name <span class="text-red-400">*</span>
                </label>
                <input type="text" name="bike_name" value="{{ old('bike_name') }}" required
                    class="w-full rounded-lg border border-neutral-600 bg-neutral-900/50 px-4 py-2.5 text-sm text-white placeholder-neutral-500 transition-all duration-200 focus:border-blue-500 focus:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                    placeholder="Enter bike name">
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">Model</label>
                <input type="text" name="model" value="{{ old('model') }}"
                    class="w-full rounded-lg border border-neutral-600 bg-neutral-900/50 px-4 py-2.5 text-sm text-white placeholder-neutral-500 transition-all duration-200 focus:border-blue-500 focus:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                    placeholder="Enter model">
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">Price Per Day ($)</label>
                <input type="number" name="price_per_day" step="0.01" min="0" value="{{ old('price_per_day') }}"
                    class="w-full rounded-lg border border-neutral-600 bg-neutral-900/50 px-4 py-2.5 text-sm text-white placeholder-neutral-500 transition-all duration-200 focus:border-blue-500 focus:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                    placeholder="0.00">
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">
                    Status <span class="text-red-400">*</span>
                </label>
                <select name="status" required
                    class="w-full rounded-lg border border-neutral-600 bg-neutral-900/50 px-4 py-2.5 text-sm text-white transition-all duration-200 focus:border-blue-500 focus:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="rented" {{ old('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">Bike Category</label>
                <select name="bike_category_id"
                    class="w-full rounded-lg border border-neutral-600 bg-neutral-900/50 px-4 py-2.5 text-sm text-white transition-all duration-200 focus:border-blue-500 focus:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                    <option value="">Select Category (Optional)</option>
                    @foreach($bikeCategories as $category)
                        <option value="{{ $category->id }}" {{ old('bike_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-2.5 text-sm font-medium text-white shadow-lg transition-all duration-200 hover:from-blue-700 hover:to-blue-800 hover:shadow-xl hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Bike
                </button>
            </div>
        </form>
    </div>

    {{-- Bikes Table --}}
    <div class="rounded-xl border border-neutral-700/50 bg-gradient-to-br from-neutral-800 to-neutral-900 p-6 shadow-lg">
        <div class="mb-6 flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-indigo-600">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-white">Bikes List</h2>
                <p class="text-xs text-neutral-400">Manage all your bikes</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-neutral-700">
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Bike Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Model</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Price/Day</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Category</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-700">
                    @forelse($bikes as $bike)
                    <tr class="transition-colors duration-150 hover:bg-neutral-800/50">
                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-neutral-300">{{ $loop->iteration }}</td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-white">{{ $bike->bike_name }}</td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-neutral-300">{{ $bike->model ?? 'N/A' }}</td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm font-semibold text-blue-400">${{ number_format($bike->price_per_day, 2) }}</td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm">
                            @if($bike->status == 'available')
                                <span class="inline-flex items-center gap-1 rounded-full bg-green-500/20 px-3 py-1 text-xs font-medium text-green-400 border border-green-500/30">
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span>
                                    Available
                                </span>
                            @elseif($bike->status == 'rented')
                                <span class="inline-flex items-center gap-1 rounded-full bg-red-500/20 px-3 py-1 text-xs font-medium text-red-400 border border-red-500/30">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>
                                    Rented
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 rounded-full bg-yellow-500/20 px-3 py-1 text-xs font-medium text-yellow-400 border border-yellow-500/30">
                                    <span class="h-1.5 w-1.5 rounded-full bg-yellow-400"></span>
                                    Maintenance
                                </span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-neutral-300">
                            @if($bike->bikeCategory)
                                <span class="inline-flex items-center gap-1 rounded-full bg-blue-500/20 px-2.5 py-1 text-xs font-medium text-blue-400 border border-blue-500/30">
                                    {{ $bike->bikeCategory->name }}
                                </span>
                            @else
                                <span class="text-neutral-500">N/A</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm">
                            <div class="flex items-center gap-2">
                                <button onclick="openEditModal({{ $bike->id }})"
                                    class="inline-flex items-center gap-1 rounded-lg bg-yellow-500/20 px-3 py-1.5 text-xs font-medium text-yellow-400 border border-yellow-500/30 transition-all duration-200 hover:bg-yellow-500/30 hover:scale-105">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </button>
                                <form method="POST" action="{{ route('bikes.destroy', $bike) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this bike?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 rounded-lg bg-red-500/20 px-3 py-1.5 text-xs font-medium text-red-400 border border-red-500/30 transition-all duration-200 hover:bg-red-500/30 hover:scale-105">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-neutral-700/50">
                                    <svg class="w-6 h-6 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-neutral-400">No bikes found</p>
                                <p class="text-xs text-neutral-500">Add your first bike to get started</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
@foreach($bikes as $bike)
<div id="edit-modal-{{ $bike->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 transition-opacity duration-300">
    <div class="relative w-full max-w-lg rounded-2xl border border-neutral-700 bg-gradient-to-br from-neutral-800 to-neutral-900 p-6 shadow-2xl transform transition-all duration-300 scale-95">
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-yellow-500 to-yellow-600">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">Edit Bike</h3>
                    <p class="text-xs text-neutral-400">Update bike information</p>
                </div>
            </div>
            <button onclick="closeEditModal({{ $bike->id }})" class="rounded-lg p-2 text-neutral-400 transition-colors hover:bg-neutral-700 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form method="POST" action="{{ route('bikes.update', $bike) }}" class="grid gap-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">
                    Bike Name <span class="text-red-400">*</span>
                </label>
                <input type="text" name="bike_name" value="{{ $bike->bike_name }}" required
                    class="w-full rounded-lg border border-neutral-600 bg-neutral-900/50 px-4 py-2.5 text-sm text-white placeholder-neutral-500 transition-all duration-200 focus:border-blue-500 focus:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">Model</label>
                <input type="text" name="model" value="{{ $bike->model }}"
                    class="w-full rounded-lg border border-neutral-600 bg-neutral-900/50 px-4 py-2.5 text-sm text-white placeholder-neutral-500 transition-all duration-200 focus:border-blue-500 focus:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">Price Per Day ($)</label>
                <input type="number" name="price_per_day" step="0.01" min="0" value="{{ $bike->price_per_day }}"
                    class="w-full rounded-lg border border-neutral-600 bg-neutral-900/50 px-4 py-2.5 text-sm text-white placeholder-neutral-500 transition-all duration-200 focus:border-blue-500 focus:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">
                    Status <span class="text-red-400">*</span>
                </label>
                <select name="status" required
                    class="w-full rounded-lg border border-neutral-600 bg-neutral-900/50 px-4 py-2.5 text-sm text-white transition-all duration-200 focus:border-blue-500 focus:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                    <option value="available" {{ $bike->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="rented" {{ $bike->status == 'rented' ? 'selected' : '' }}>Rented</option>
                    <option value="maintenance" {{ $bike->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">Bike Category</label>
                <select name="bike_category_id"
                    class="w-full rounded-lg border border-neutral-600 bg-neutral-900/50 px-4 py-2.5 text-sm text-white transition-all duration-200 focus:border-blue-500 focus:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                    <option value="">Select Category (Optional)</option>
                    @foreach($bikeCategories as $category)
                        <option value="{{ $category->id }}" {{ $bike->bike_category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-2.5 text-sm font-medium text-white shadow-lg transition-all duration-200 hover:from-blue-700 hover:to-blue-800 hover:shadow-xl">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Bike
                </button>
                <button type="button" onclick="closeEditModal({{ $bike->id }})"
                    class="rounded-lg border border-neutral-600 bg-neutral-800 px-4 py-2.5 text-sm font-medium text-neutral-300 transition-all duration-200 hover:bg-neutral-700 hover:text-white">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

<script>
function openEditModal(id) {
    const modal = document.getElementById('edit-modal-' + id);
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.querySelector('.transform').classList.remove('scale-95');
        modal.querySelector('.transform').classList.add('scale-100');
    }, 10);
}

function closeEditModal(id) {
    const modal = document.getElementById('edit-modal-' + id);
    modal.querySelector('.transform').classList.remove('scale-100');
    modal.querySelector('.transform').classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 200);
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('backdrop-blur-sm')) {
        const modals = document.querySelectorAll('[id^="edit-modal-"]');
        modals.forEach(modal => {
            if (!modal.classList.contains('hidden')) {
                const id = modal.id.replace('edit-modal-', '');
                closeEditModal(id);
            }
        });
    }
});
</script>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}
</style>
</x-layouts.app>
