<x-layouts.app :title="__('Dashboard')">

<style>
    select option { color: #000 !important; background-color: #fff !important; }
    html.dark select option { color: #fff !important; background-color: #1f2937 !important; }
</style>

<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

    @php
        $students = $students ?? collect();
        $brands = $brands ?? collect();
    @endphp

    <!-- Stats Cards -->
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <div class="bg-blue-500 text-white rounded-lg p-4 shadow">
            <h3 class="text-sm">Total Rented Bikes</h3>
            <p class="text-2xl font-bold">{{ $totalRented }}</p>
        </div>

        <div class="bg-green-500 text-white rounded-lg p-4 shadow">
            <h3 class="text-sm">Available Bikes</h3>
            <p class="text-2xl font-bold">{{ $availableBikes }}</p>
        </div>

        <div class="bg-purple-500 text-white rounded-lg p-4 shadow">
            <h3 class="text-sm">Customer Satisfaction</h3>
            <p class="text-2xl font-bold">{{ $customerSatisfaction }}%</p>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="bg-green-600 text-white p-3 rounded">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="bg-red-600 text-white p-3 rounded">{{ session('error') }}</div>
    @endif


    <!-- ADD CUSTOMER -->
    <div class="rounded-lg border bg-neutral-50 p-6 dark:bg-neutral-900/50">
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
                    <option disabled selected>Select Bike</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->brand_name }}">
                            {{ $brand->brand_name }} ({{ $brand->bikes_count }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm">Phone</label>
                <input type="text" name="phone" required class="w-full rounded border px-4 py-2">
            </div>

            <div class="md:col-span-2">
                <button class="bg-blue-600 text-white px-6 py-2 rounded">Add Customer</button>
            </div>
        </form>
    </div>


    <!-- CUSTOMER TABLE -->
    <div class="flex-1 overflow-auto mt-4">
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

            <tbody>
                @foreach ($students as $student)
                <tr class="border-b">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ $student->name }}</td>
                    <td class="px-4 py-3">{{ $student->location }}</td>
                    <td class="px-4 py-3">{{ $student->select_bike }}</td>
                    <td class="px-4 py-3">{{ $student->phone }}</td>

                    <td class="px-4 py-3">
                        <button onclick="openEditModal(@js($student))"
                                class="text-blue-600">Edit</button>

                        <form action="{{ route('students.destroy', $student->id) }}"
                              method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 ml-1"
                                    onclick="return confirm('Delete this customer?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- EDIT MODAL -->
    <div id="editModal"
         class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white dark:bg-neutral-800 p-6 rounded w-full max-w-lg">
            <h2 class="mb-4 text-lg font-semibold">Edit Customer</h2>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label>Name</label>
                    <input id="edit_name" name="name" class="w-full rounded border px-3 py-2">
                </div>

                <div class="mb-4">
                    <label>Location</label>
                    <input id="edit_location" name="location" class="w-full rounded border px-3 py-2">
                </div>

                <div class="mb-4">
                    <label>Select Bike</label>
                    <select id="edit_select_bike" name="select_bike" class="w-full rounded border px-3 py-2">
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->brand_name }}">{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label>Phone</label>
                    <input id="edit_phone" name="phone" class="w-full rounded border px-3 py-2">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 bg-gray-300 rounded">Cancel</button>

                    <button class="px-4 py-2 bg-blue-600 text-white rounded">
                        Update
                    </button>
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

    const url = "{{ route('students.update', ':id') }}".replace(':id', student.id);
    document.getElementById('editForm').action = url;

    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>

</x-layouts.app>
