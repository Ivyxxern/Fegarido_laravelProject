{{-- resources/views/brands/index.blade.php --}}
<x-layouts.app>
    <div class="p-8">
        <h1 class="text-3xl font-semibold mb-6 text-white">Manage Brands</h1>

        {{-- Add Brand Form --}}
        <div class="mb-8 bg-zinc-900 border border-zinc-700 rounded-lg p-4 flex flex-wrap items-center gap-3">
            <form action="{{ route('brands.store') }}" method="POST" class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                @csrf
                <input
                    type="text"
                    name="brand_name"
                    placeholder="Brand Name"
                    class="px-3 py-2 rounded bg-zinc-800 border border-zinc-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-64"
                    required
                >
                <button
                    type="submit"
                    class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-500 text-white font-medium"
                >
                    Add Brand
                </button>
            </form>

            @error('brand_name')
                <p class="text-red-400 text-sm mt-2 w-full sm:w-auto">{{ $message }}</p>
            @enderror
        </div>

        {{-- Brands Table --}}
        <div class="bg-zinc-900 border border-zinc-700 rounded-lg overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-red-600 text-white">
                        <th class="px-4 py-3 text-left">Brand Name</th>
                        <th class="px-4 py-3 text-center">Total Bikes</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $brand)
                        <tr class="border-t border-zinc-700 hover:bg-zinc-800">
                            <td class="px-4 py-3 text-white">
                                {{ $brand->brand_name }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-zinc-800 text-zinc-200 text-xs">
                                    {{ $brand->bikes_count }} bikes
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-4">
                                    {{-- Edit button opens modal --}}
                                    <button
                                        type="button"
                                        onclick="openEditModal({{ $brand->id }}, '{{ $brand->brand_name }}')"
                                        class="text-blue-400 hover:text-blue-300 underline"
                                    >
                                        Edit
                                    </button>

                                    {{-- Delete --}}
                                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Delete this brand?');">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-red-400 hover:text-red-300 underline"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-zinc-400">
                                No brands found. Add one above.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Edit Brand Modal --}}
    <div id="editModal"
         class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-zinc-900 border border-zinc-700 rounded-lg p-6 w-80">
            <h2 class="text-lg font-semibold mb-4 text-white">Edit Brand</h2>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <label class="block text-sm text-zinc-300 mb-1" for="editBrandName">
                    Brand Name
                </label>
                <input
                    type="text"
                    id="editBrandName"
                    name="brand_name"
                    class="w-full px-3 py-2 mb-4 rounded bg-zinc-800 border border-zinc-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >

                <div class="flex justify-end gap-3">
                    <button
                        type="button"
                        onclick="closeEditModal()"
                        class="px-4 py-2 rounded bg-zinc-700 text-zinc-200 hover:bg-zinc-600"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-500"
                    >
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal script --}}
    <script>
        function openEditModal(id, name) {
            const modal = document.getElementById('editModal');
            const input = document.getElementById('editBrandName');
            const form = document.getElementById('editForm');

            input.value = name;
            form.action = `/brands/${id}`;
            modal.classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</x-layouts.app>

