<x-layouts.app :title="__('Dashboard')">

    <!-- Fix dropdown options visibility -->
    <style>
        select option {
            color: #000 !important;     
            background-color: #fff !important;  
        }
        html.dark select option {
            color: #fff !important;     
            background-color: #1f2937 !important; 
        }
    </style>

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        @php
            $students = $students ?? collect();
            $brands = $brands ?? collect();
            $totalRented = $totalRented ?? 0;
            $availableBikes = $availableBikes ?? 0;
            $customerSatisfaction = $customerSatisfaction ?? 100;
        @endphp

        <!-- Stats Cards with Icons -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

            <!-- Total Rented Bikes -->
            <div class="bg-blue-500 text-white rounded-lg p-4 shadow hover:scale-105 transform transition duration-300 flex items-center gap-4">
                <!-- Icon -->
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 13l4 4L19 7"/>
                </svg>
                <div>
                    <h3 class="text-sm">Total Rented Bikes</h3>
                    <p class="text-2xl font-bold">{{ $totalRented }}</p>
                </div>
            </div>

            <!-- Available Bikes -->
            <div class="bg-green-500 text-white rounded-lg p-4 shadow hover:scale-105 transform transition duration-300 flex items-center gap-4">
                <!-- Icon -->
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"/>
                </svg>
                <div>
                    <h3 class="text-sm">Available Bikes</h3>
                    <p class="text-2xl font-bold">{{ $availableBikes }}</p>
                </div>
            </div>

            <!-- Customer Satisfaction -->
            <div class="bg-purple-500 text-white rounded-lg p-4 shadow hover:scale-105 transform transition duration-300 flex items-center gap-4">
                <!-- Icon -->
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                    <line x1="9" y1="9" x2="9.01" y2="9"/>
                    <line x1="15" y1="9" x2="15.01" y2="9"/>
                </svg>
                <div>
                    <h3 class="text-sm">Customer Satisfaction</h3>
                    <p class="text-2xl font-bold">{{ $customerSatisfaction }}%</p>
                </div>
            </div>

        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-600/20 border border-green-600 text-green-700 p-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-lg bg-red-600/20 border border-red-600 text-red-700 p-3">
                {{ session('error') }}
            </div>
        @endif

        <!-- Add Customer Form -->
        <div class="mb-6 rounded-lg border bg-neutral-50 p-6 dark:border-neutral-700 dark:bg-neutral-900/50">
            <h2 class="mb-4 text-lg font-semibold">Add New Customer</h2>

            <form action="{{ route('students.store') }}" method="POST" class="grid gap-4 md:grid-cols-2">
                @csrf

                <div>
                    <label class="text-sm">Name</label>
                    <input type="text" name="name" required class="w-full rounded border px-4 py-2">
                </div>

                <div>
                    <label class="text-sm">Location</label>
                    <input type="text" name="location" required class="w-full rounded border px-4 py-2">
                </div>

                <div>
                    <label class="text-sm">Select Bike</label>
                    <select name="select_bike" class="border rounded p-2 w-full" required>
                        <option value="" disabled selected>Select Bike</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->brand_name }}">
                                {{ $brand->brand_name }} ({{ $brand->bikes_count ?? 0 }} bikes)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm">Phone</label>
                    <input type="text" name="phone" required class="w-full rounded border px-4 py-2">
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">
                        Add Customer
                    </button>
                </div>
            </form>
        </div>

        <!-- Customer Table -->
        <div class="flex-1 overflow-auto">
            <h2 class="mb-4 text-lg font-semibold">Customer List</h2>

            <table class="w-full">
                <thead>
                    <tr class="border-b bg-neutral-50 dark:bg-neutral-900/50">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Location</th>
                        <th class="px-4 py-3">Bike</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($students as $student)
                        <tr>
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $student->name }}</td>
                            <td class="px-4 py-3">{{ $student->location }}</td>
                            <td class="px-4 py-3">{{ $student->select_bike }}</td>
                            <td class="px-4 py-3">{{ $student->phone }}</td>

                            <td class="px-4 py-3">
                                <button onclick="openEditModal(@json($student))" class="text-blue-600">Edit</button>

                                <form action="{{ route('students.destroy', $student->id) }}" 
                                      method="POST" class="inline" 
                                      onsubmit="return confirm('Are you sure you wanna delete this?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 ml-1">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-neutral-800 p-6 rounded-lg w-full max-w-lg">

                <h2 class="mb-4 text-lg font-semibold">Edit Customer</h2>

                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Name</label>
                        <input type="text" name="name" id="edit_name" class="w-full rounded border px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label>Location</label>
                        <input type="text" name="location" id="edit_location" class="w-full rounded border px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label>Select Bike</label>
                        <select name="select_bike" id="edit_select_bike" class="w-full rounded border px-3 py-2">
                            @foreach($brands as $brand)
                                <option value="{{ $brand->brand_name }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Phone</label>
                        <input type="text" name="phone" id="edit_phone" class="w-full rounded border px-3 py-2">
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        function openEditModal(student) {
            document.getElementById("edit_name").value = student.name;
            document.getElementById("edit_location").value = student.location;
            document.getElementById("edit_select_bike").value = student.select_bike;
            document.getElementById("edit_phone").value = student.phone;

            document.getElementById("editForm").action = "/students/" + student.id;
            document.getElementById("editModal").classList.remove("hidden");
        }

        function closeEditModal() {
            document.getElementById("editModal").classList.add("hidden");
        }
    </script>

</x-layouts.app>
