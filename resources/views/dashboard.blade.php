<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <!-- Stats Cards -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <!-- Total Rented Bikes -->
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Rented Bikes</p>
                        <h3 class="mt-2 text-3xl font-bold text-neutral-900 dark:text-neutral-100">15</h3>
                    </div>
                    <div class="rounded-full bg-blue-100 p-3 dark:bg-blue-900/30">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Available Bikes -->
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Available Bikes</p>
                        <h3 class="mt-2 text-3xl font-bold text-neutral-900 dark:text-neutral-100">30</h3>
                    </div>
                    <div class="rounded-full bg-green-100 p-3 dark:bg-green-900/30">
                        <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Customer Satisfaction -->
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Customer Satisfaction</p>
                        <h3 class="mt-2 text-3xl font-bold text-neutral-900 dark:text-neutral-100">92%</h3>
                    </div>
                    <div class="rounded-full bg-purple-100 p-3 dark:bg-purple-900/30">
                        <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
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

        <!-- Add New Customer Form -->
        <div class="mb-6 rounded-lg border border-neutral-200 bg-neutral-50 p-6 dark:border-neutral-700 dark:bg-neutral-900/50">
            <h2 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100">Add New Customer</h2>
            <form action="{{ route('students.store') }}" method="POST" class="grid gap-4 md:grid-cols-2">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter customer name" required
                        class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    @error('name') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" placeholder="Enter Location" required
                        class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    @error('location') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Select Bike</label>
                    <select name="select_bike" required
                        class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                        <option disabled selected>Select a Bike</option>
                        <option value="Bianchi">Bianchi</option>
                        <option value="Cannondale">Cannondale</option>
                        <option value="Trek">Trek</option>
                        <option value="Trinx">Trinx</option>
                        <option value="Scott">Scott</option>
                        <option value="Specialized">Specialized</option>
                    </select>
                    @error('select_bike') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone" required
                        class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    @error('phone') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                        Add Customer
                    </button>
                </div>
            </form>
        </div>

        <!-- Customer List Table -->
        <div class="flex-1 overflow-auto">
            <h2 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100">Customer List</h2>
            <div class="overflow-x-auto">
                <table class="w-full min-w-full">
                    <thead>
                        <tr class="border-b border-neutral-200 bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-900/50">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">#</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Name</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Location</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Select Bike</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Phone</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse ($students as $student)
                        <tr class="transition-colors hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                            <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm">{{ $student->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $student->location }}</td>
                            <td class="px-4 py-3 text-sm">{{ $student->select_bike }}</td>
                            <td class="px-4 py-3 text-sm">{{ $student->phone }}</td>
                            <td class="px-4 py-3 text-sm">
                                <button onclick="openEditModal({{ $student }})" class="text-blue-600 hover:text-blue-700">Edit</button>
                                <span class="mx-1 text-neutral-400">|</span>
                                <form method="POST" action="{{ route('students.destroy', $student->id) }}" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this customer?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-sm">
                                No customers found. Add your first customer above!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Edit Customer Modal -->
        <div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-neutral-800 p-6 rounded-lg w-full max-w-lg">
                <h2 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100">Edit Customer</h2>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-300">Name</label>
                        <input type="text" name="name" id="edit_name" required
                            class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-300">Location</label>
                        <input type="text" name="location" id="edit_location" required
                            class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-300">Select Bike</label>
                        <select name="select_bike" id="edit_select_bike" required
                            class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                            <option value="Bianchi">Bianchi</option>
                            <option value="Cannondale">Cannondale</option>
                            <option value="Trek">Trek</option>
                            <option value="Trinx">Trinx</option>
                            <option value="Scott">Scott</option>
                            <option value="Specialized">Specialized</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-300">Phone</label>
                        <input type="text" name="phone" id="edit_phone" required
                            class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-lg bg-gray-300 dark:bg-gray-700">Cancel</button>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        function openEditModal(student) {
            document.getElementById('edit_name').value = student.name;
            document.getElementById('edit_location').value = student.location;
            document.getElementById('edit_select_bike').value = student.select_bike;
            document.getElementById('edit_phone').value = student.phone;
            document.getElementById('editForm').action = `/students/${student.id}`;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</x-layouts.app>
