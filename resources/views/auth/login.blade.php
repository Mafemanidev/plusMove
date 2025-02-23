@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="loginTabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="tracking-tab" data-bs-toggle="tab" href="#tracking">Track Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="login-tab" data-bs-toggle="tab" href="#login">Login</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body tab-content">
                        <!-- Tracking Form -->
                        <div class="tab-pane fade show active" id="tracking">
                            <div class="card shadow-lg">
{{--                                <div class="card-header text-center bg-dark text-white">--}}
{{--                                    <h4>Track package</h4>--}}
{{--                                </div>--}}
                                <div class="card-body">
                                    <form method="GET" action="{{ route('tracking.show', '') }}" id="trackingForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="tracking_number" class="form-label">Enter Tracking Number</label>
                                            <input type="text" name="tracking_number" id="tracking_number" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Track Order</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Login Form -->
                        <div class="tab-pane fade" id="login">
                            <div class="card shadow-lg">
{{--                                <div class="card-header text-center bg-dark text-white">--}}
{{--                                    <h4>Login to PlusMove</h4>--}}
{{--                                </div>--}}
                                <div class="card-body">
                                    <!-- Display Success Message -->
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <!-- Session Status -->
                                    @if (session('status'))
                                        <div class="alert alert-info">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <!-- Email Address -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" required autofocus>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                            <label class="form-check-label" for="remember_me">Remember me</label>
                                        </div>

                                        <!-- Login Button -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            @if (Route::has('password.request'))
                                                <a class="text-muted" href="{{ route('password.request') }}">Forgot your password?</a>
                                            @endif

                                            <button type="submit" class="btn btn-dark">Log in</button>
                                        </div>

                                        <!-- Register Link -->
                                        <div class="text-center mt-3">
                                            <p>Don't have an account? <a href="{{ route('register') }}" class="text-primary">Register here</a></p>
                                        </div>

                                    </form>
                                </div>
                            </div>
{{--                            <form method="POST" action="{{ route('login') }}">--}}
{{--                                @csrf--}}

{{--                                <div class="mb-3">--}}
{{--                                    <label for="email" class="form-label">Email Address</label>--}}
{{--                                    <input type="email" name="email" id="email" class="form-control" required autofocus>--}}
{{--                                </div>--}}

{{--                                <div class="mb-3">--}}
{{--                                    <label for="password" class="form-label">Password</label>--}}
{{--                                    <input type="password" name="password" id="password" class="form-control" required>--}}
{{--                                </div>--}}

{{--                                <div class="mb-3 form-check">--}}
{{--                                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">--}}
{{--                                    <label class="form-check-label" for="remember_me">Remember Me</label>--}}
{{--                                </div>--}}

{{--                                <button type="submit" class="btn btn-dark w-100">Log in</button>--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Handle Tracking Form Submission -->
    <script>
        document.getElementById('trackingForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let trackingNumber = document.getElementById('tracking_number').value;
            if (trackingNumber) {
                window.location.href = "{{ route('tracking.show', '') }}/" + trackingNumber;
            }
        });
    </script>
@endsection
