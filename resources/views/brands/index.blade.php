<x-layouts.app :title="__('Brands')">
    <div class="p-6">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-500/20 border border-green-600 text-green-800 dark:text-green-300 p-3">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="mb-4 rounded-lg bg-red-500/20 border border-red-600 text-red-800 dark:text-red-300 p-3">
                ❌ {{ session('error') }}
            </div>
        @endif

        {{-- Add Brand --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Add New Brand</h2>

            <form action="{{ route('brands.store') }}" method="POST" class="flex gap-2">
                @csrf

                <input type="text" name="brand_name" placeholder="Brand Name" required
                    class="border rounded px-3 py-2 w-full">

                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    ➕ Add Brand
                </button>
            </form>
        </div>

        {{-- Brands Table --}}
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
                            <td class="px-4 py-2">{{ $brand->brand_name }}</td>
                            <td class="px-4 py-2">{{ $brand->bikes_count ?? 0 }} bikes</td>

                            <td class="px-4 py-2 flex items-center gap-3">
                                {{-- Edit Brand Button --}}
                                <button onclick="openEditBrandModal({{ $brand->id }}, '{{ $brand->brand_name }}')"
                                    class="text-blue-600 hover:text-blue-800 font-medium">
                                    ✏️ Edit
                                </button>

                                {{-- Delete Brand Button --}}
                                <form method="POST" action="{{ route('brands.destroy', $brand->id) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this brand?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 hover:text-red-800 font-medium">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center">
                                No brands found — add your first brand above!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Edit Brand Modal --}}
        <div id="editBrandModal" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg w-96 p-6 relative">
                <h3 class="text-lg font-semibold mb-4">Edit Brand</h3>

                <form id="editBrandForm" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="text" name="brand_name" id="editBrandName" placeholder="Brand Name" required
                        class="border rounded px-3 py-2 w-full mb-4">

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeEditBrandModal()"
                                class="px-4 py-2 rounded border hover:bg-gray-100 dark:hover:bg-gray-700">Cancel</button>

                        <button type="submit"
                                class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Update</button>
                    </div>
                </form>

                <button onclick="closeEditBrandModal()"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 text-xl">&times;</button>
            </div>
        </div>

    </div>

    {{-- JavaScript to handle the modal --}}
    <script>
        // Open the Edit Brand Modal and set the data for the brand
        function openEditBrandModal(id, brandName) {
            document.getElementById('editBrandName').value = brandName;
            document.getElementById('editBrandForm').action = '/brands/' + id; // Update the form action with the correct route
            document.getElementById('editBrandModal').classList.remove('hidden');
        }

        // Close the Edit Brand Modal
        function closeEditBrandModal() {
            document.getElementById('editBrandModal').classList.add('hidden');
        }
    </script>
</x-layouts.app>
