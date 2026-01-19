<x-layouts.app :title="__('Trash')">
<div class="flex h-full w-full flex-col gap-6 p-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Trash</h1>
            <p class="text-sm text-neutral-400 mt-1">Restore or permanently delete bikes</p>
        </div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-200 hover:from-blue-700 hover:to-blue-800 hover:shadow-xl">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Dashboard
        </a>
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

    {{-- Search and Filter Section --}}
    <div class="rounded-xl border border-neutral-700/50 bg-gradient-to-br from-neutral-800 to-neutral-900 p-6 shadow-lg">
        <form method="GET" action="{{ route('trash') }}" class="grid gap-4 md:grid-cols-4">
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">
                    Search
                </label>
                <input type="text" name="search" value="{{ $searchValue }}"
                    class="w-full rounded-lg border border-neutral-600 bg-neutral-900/50 px-4 py-2.5 text-sm text-white placeholder-neutral-500 transition-all duration-200 focus:border-blue-500 focus:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                    placeholder="Search by name or model">
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">
                    Filter by Category
                </label>
                <select name="category"
                    class="w-full rounded-lg border border-neutral-600 bg-neutral-900/50 px-4 py-2.5 text-sm text-white transition-all duration-200 focus:border-blue-500 focus:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                    <option value="">All Categories</option>
                    @foreach($bikeCategories as $category)
                        <option value="{{ $category->id }}" {{ $categoryFilter == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-2.5 text-sm font-medium text-white shadow-lg transition-all duration-200 hover:from-blue-700 hover:to-blue-800 hover:shadow-xl">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Apply
                </button>
                @if($searchValue || $categoryFilter)
                <a href="{{ route('trash') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-neutral-600 bg-neutral-800 px-4 py-2.5 text-sm font-medium text-neutral-300 transition-all duration-200 hover:bg-neutral-700 hover:text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Clear
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Trash Table --}}
    <div class="rounded-xl border border-neutral-700/50 bg-gradient-to-br from-neutral-800 to-neutral-900 p-6 shadow-lg">
        <div class="mb-6 flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-red-500 to-red-600">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-white">Deleted Bikes</h2>
                <p class="text-xs text-neutral-400">Restore or permanently delete bikes from trash</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-neutral-700">
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Photo</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Bike Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Model</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Price/Day</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Category</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Deleted At</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-700">
                    @forelse($trashedBikes as $bike)
                    <tr class="transition-colors duration-150 hover:bg-neutral-800/50">
                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-neutral-300">{{ $loop->iteration }}</td>
                        <td class="whitespace-nowrap px-4 py-4">
                            @if($bike->photo)
                                <div class="h-10 w-10 rounded-full overflow-hidden border-2 border-neutral-600">
                                    <img src="{{ url('/storage/' . $bike->photo) }}" alt="{{ $bike->bike_name }}" class="h-full w-full object-cover" onerror="this.parentElement.innerHTML='<div class=\'flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-blue-600 text-white text-xs font-semibold border-2 border-neutral-600\'>{{ $bike->initials() }}</div>'">
                                </div>
                            @else
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-blue-600 text-white text-xs font-semibold border-2 border-neutral-600">
                                    {{ $bike->initials() }}
                                </div>
                            @endif
                        </td>
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
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-neutral-400">
                            {{ $bike->deleted_at->format('M d, Y H:i') }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm">
                            <div class="flex items-center gap-2">
                                <form method="POST" action="{{ route('bikes.restore', $bike->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1 rounded-lg bg-green-500/20 px-3 py-1.5 text-xs font-medium text-green-400 border border-green-500/30 transition-all duration-200 hover:bg-green-500/30 hover:scale-105">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Restore
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('bikes.force-delete', $bike->id) }}"
                                      onsubmit="return confirm('Are you sure you want to permanently delete this bike? This action cannot be undone.')" class="inline">
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
                        <td colspan="9" class="px-4 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-neutral-700/50">
                                    <svg class="w-6 h-6 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-neutral-400">Trash is empty</p>
                                <p class="text-xs text-neutral-500">No deleted bikes found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

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
