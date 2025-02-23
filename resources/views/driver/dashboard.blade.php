@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3">Driver Dashboard</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Tracking Code</th>
                <th>From</th>
                <th>To</th>
                <th>Last Tracking Status</th>
                <th>Update Tracking</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td><strong>{{ $order->tracking_code }}</strong></td>
                    <td>{{ $order->warehouse->name }}</td>
                    <td>{{ $order->to_address }}</td>
                    <td>
                        @if ($order->trackingDetails->isNotEmpty())
                            @php
                                $lastStatus = $order->trackingDetails->first()->status;
                            @endphp
                            <span class="{{ $lastStatus === 'Failed to Deliver' ? 'text-danger' : '' }}">
                                {{ $lastStatus }}
                            </span>
                        @else
                            <span class="text-muted">No updates yet</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('driver.tracking.update', $order->id) }}" method="POST">
                            @csrf
                            <select name="status" class="form-select" required>
                                @foreach(App\Models\StatusProgress::all() as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="message" class="form-control mt-2" placeholder="Optional message">
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
