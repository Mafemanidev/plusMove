@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3">Edit Order</h2>

        <form method="POST" action="{{ route('orders.update', $order->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Weight (kg)</label>
                <input type="number" step="0.1" name="weight" class="form-control" value="{{ $order->weight }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Number of Packages</label>
                <input type="number" name="num_packages" class="form-control" value="{{ $order->num_packages }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">From Warehouse</label>
                <select name="warehouse_id" class="form-select" required>
                    @foreach($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}" {{ $order->warehouse_id == $warehouse->id ? 'selected' : '' }}>
                            {{ $warehouse->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">To Address</label>
                <input type="text" name="to_address" class="form-control" value="{{ $order->to_address }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Assign Driver</label>
                <select name="driver_id" class="form-select">
                    <option value="">-- Select Driver --</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ $order->driver_id == $driver->id ? 'selected' : '' }}>
                            {{ $driver->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update Order</button>
        </form>
    </div>
@endsection
