@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action active">Dashboard</a>
                    <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action">Orders</a>
                </div>
            </div>
            <div class="col-md-9">
                <h2>Welcome to the PlusMove Dashboard</h2>
                <p>Manage deliveries, drivers, and orders efficiently.</p>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Orders</h5>
                                <p class="card-text">No drivers allocated</p>
                                <p class="card-text">{{ $totalOrders }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Active Drivers</h5>
                                <p class="card-text">Available Drivers</p>
                                <p class="card-text">{{ $totalDrivers }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Pending Deliveries</h5>
                                <p class="card-text">Drivers allocated</p>
                                <p class="card-text">{{ $pendingDeliveries }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
