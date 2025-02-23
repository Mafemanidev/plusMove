@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2 class="text-danger">Unauthorized Access</h2>
        <p>You do not have permission to access this page.</p>
        <a href="{{ auth()->check() ? (auth()->user()->group->name === 'Driver' ? route('driver.dashboard') : route('dashboard')) : route('login') }}" class="btn btn-primary">
            Go to Home
        </a>
    </div>
@endsection
