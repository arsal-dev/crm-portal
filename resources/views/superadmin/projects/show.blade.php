@extends('superadmin.layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->project_name }}</h5>
                    <p class="card-text">{{ $project->project_description }}</p>
                    <img src="{{ asset('storage/' . $project->project_image) }}" class="img-fluid" alt="Project Image">

                    <h5 class="mt-4">Inventories</h5>

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
                                    <th>Sold</th>
                                    <th>Price Change</th> <!-- Add this column -->
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
                                            @if ($inventory->sold)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($inventory->priceChange->isEmpty())
                                                N/A
                                            @else
                                                <ul>
                                                    @foreach ($inventory->priceChange as $priceChange)
                                                        <li>
                                                            @if ($priceChange->change_type === 'appreciation')
                                                                <span
                                                                    class="text-success">+{{ number_format($priceChange->amount, 2) }}</span>
                                                            @elseif ($priceChange->change_type === 'depreciation')
                                                                <span
                                                                    class="text-danger">-{{ number_format($priceChange->amount, 2) }}</span>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pie chart</h4>
                    <canvas id="pieChart" inventories="{{ json_encode($inventories) }}" style="height:250px"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
