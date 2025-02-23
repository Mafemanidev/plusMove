@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tracking Details for {{ $order->tracking_code }}</h2>
        <p><strong>From:</strong> {{ $order->warehouse->name }}</p>
        <p><strong>To:</strong> {{ $order->to_address }}</p>

        <h3>Tracking History</h3>
        <ul class="list-group">
            @foreach($trackingDetails as $detail)
                <li class="list-group-item">
                    <strong>{{ $detail->status }}</strong> - {{ $detail->message }} ({{ $detail->created_at->format('d M Y, H:i') }})
                </li>
            @endforeach
        </ul>
    </div>
@endsection
