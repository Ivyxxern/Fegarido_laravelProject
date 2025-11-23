<h1 class="text-2xl font-bold mb-4">Bike Dashboard</h1>

<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="p-4 bg-orange-200 rounded">Total Bikes: {{ $totalBikes }}</div>
    <div class="p-4 bg-gray-200 rounded">Available: {{ $availableBikes }}</div>
    <div class="p-4 bg-green-200 rounded">Static Card</div>
</div>

<form method="POST" action="/bikes" class="mb-6">
    @csrf
    <input type="text" name="bike_name" placeholder="Bike Name" class="border p-2">
    <select name="brand_id" class="border p-2">
        <option value="">No Brand</option>
        @foreach($brands as $b)
        <option value="{{ $b->id }}">{{ $b->brand_name }}</option>
        @endforeach
    </select>
    <button class="bg-blue-500 text-white px-3 py-2">Add Bike</button>
</form>

<table class="w-full border">
    <tr class="bg-gray-100">
        <th class="p-2">Bike</th>
        <th class="p-2">Brand</th>
        <th class="p-2">Status</th>
        <th class="p-2">Actions</th>
    </tr>

    @foreach($bikes as $bike)
    <tr class="border-b">
        <td class="p-2">{{ $bike->bike_name }}</td>
        <td class="p-2">{{ $bike->brand->brand_name ?? 'N/A' }}</td>
        <td class="p-2">{{ $bike->status }}</td>
        <td class="p-2">
            <form action="/bikes/{{ $bike->id }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button class="text-red-500">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
