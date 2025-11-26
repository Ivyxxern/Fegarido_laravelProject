<x-layouts.app :title="__('Brands')">
    <div class="p-6">
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-600/20 border border-green-600 text-green-700 dark:text-green-300 p-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-lg bg-red-600/20 border border-red-600 text-red-700 dark:text-red-300 p-3">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Add New Brand</h2>
            <form action="{{ route('brands.store') }}" method="POST" class="flex gap-2">
                @csrf
                <input type="text" name="name" placeholder="Brand Name" required
                    class="border rounded px-3 py-2 w-full">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Brand</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border">
                <thead>
                    <tr class="bg-neutral-50 dark:bg-neutral-900/50">
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Brand Name</th>
                        <th class="px-4 py-2">Total Bikes</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse ($brands as $brand)
                        <tr>
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $brand->name }}</td>
                            <td class="px-4 py-2">{{ $brand->bikes_count ?? 0 }} bikes</td>
                            <td class="px-4 py-2">
                                <button onclick="openEditBrandModal({{ $brand }})" class="text-blue-600 hover:text-blue-700">
                                    Edit
                                </button>
                                <span class="mx-1 text-neutral-400">|</span>
                                <form method="POST" action="{{ route('brands.destroy', $brand->id) }}" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this brand?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center">No brands found. Add your first brand above!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
