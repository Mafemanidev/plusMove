@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3">Orders</h2>

        <!-- Bootstrap Alert for Explanation -->
        <div class="alert alert-info">
            <strong>Orders vs Deliveries:</strong>
            <ul>
                <li><strong>Order</strong> - An order that has not been assigned a driver.</li>
                <li><strong>Delivery</strong> - An order that has been assigned to a driver.</li>
            </ul>
            <p>Please assign a driver to mark an order as a delivery.</p>
        </div>

        <!-- Button to Add New Order -->
        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Add New Order</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Orders Table -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Tracking Code</th>
                <th>Type</th> <!-- New Type Column -->
                <th>Weight (kg)</th>
                <th>Packages</th>
                <th>From Warehouse</th>
                <th>To Address</th>
                <th>Assigned Driver</th>
                <th>Actions</th> <!-- Actions Column -->
            </tr>
            </thead>
            <tbody>
            @foreach($orders->sortByDesc('created_at') as $order) <!-- Sorting Orders by Most Recent -->
            <tr>
                <td>
                    <a href="{{ route('tracking.show', $order->tracking_code) }}" class="text-primary">
                        {{ $order->tracking_code }}
                    </a>
                </td>
                <td>
                        <span class="badge {{ $order->driver ? 'bg-success' : 'bg-warning' }}">
                            {{ $order->driver ? 'Delivery' : 'Order' }}
                        </span>
                </td>
                <td>{{ $order->weight }}</td>
                <td>{{ $order->num_packages }}</td>
                <td>{{ $order->warehouse->name }}</td>
                <td>{{ $order->to_address }}</td>
                <td>{{ $order->driver ? $order->driver->name : 'Not Assigned' }}</td>
                <td>
                    @if(!$order->driver) <!-- Only show actions if driver is NOT assigned -->
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                    </form>
                    @else
                        <span class="text-muted">Driver Assigned</span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
