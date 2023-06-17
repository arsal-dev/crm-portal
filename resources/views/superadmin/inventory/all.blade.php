@extends('superadmin.layouts.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">All Inventory Items</h5>

            @if ($inventories->isEmpty())
                <p>No inventory items available.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Picture</th>
                            <th>Area</th>
                            <th>Price</th>
                            <th>Change</th>
                            <th>Project</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $inventory)
                            <tr>
                                <td>{{ $inventory->name }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $inventory->picture) }}" alt="Inventory Image"
                                        class="img-fluid">
                                </td>
                                <td>{{ $inventory->area }}</td>
                                <td>{{ number_format($inventory->price, 2) }} PKR</td>
                                <td>
                                    @if ($inventory->priceChange->isEmpty())
                                        N/A
                                    @else
                                        @foreach ($inventory->priceChange as $priceChange)
                                            @if ($priceChange->change_type === 'appreciation')
                                                <span
                                                    class="text-success">+{{ number_format($priceChange->amount, 2) }}</span>
                                            @elseif ($priceChange->change_type === 'depreciation')
                                                <span
                                                    class="text-danger">-{{ number_format($priceChange->amount, 2) }}</span>
                                            @endif
                                            <br>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $inventory->project->project_name }}</td>
                                <td>
                                    <a href="{{ route('inventory.edit', ['id' => $inventory->id]) }}"
                                        class="btn btn-outline-primary" title="Edit Inventory">
                                        <i class="mdi mdi-table-edit"></i>
                                    </a>
                                    <form action="{{ route('inventory.destroy', ['id' => $inventory->id]) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this inventory item?')"
                                            title="Delete Inventory">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
