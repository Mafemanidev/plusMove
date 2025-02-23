@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-dark text-white">
                    <h4>Create an Account</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required>
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

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>

                        <!-- Profile Picture Upload -->
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input id="profile_picture" type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                                   name="profile_picture" accept="image/*">
                            @error('profile_picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Group Selection (Role) -->
                        <div class="mb-3">
                            <label for="group_id" class="form-label">Select Your Role</label>
                            <select id="group_id" name="group_id" class="form-select @error('group_id') is-invalid @enderror" required>
                                <option value="">-- Select Role --</option>
                                @foreach($groups as $group)
                                    @if($group->name !== 'Customer') <!-- Remove Customer -->
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('group_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Vehicle Type Selection (Only Show for Drivers) -->
                        <div class="mb-3" id="vehicleTypeSection" style="display: none;">
                            <label for="vehicle_type_id" class="form-label">Select Vehicle Type</label>
                            <select id="vehicle_type_id" name="vehicle_type_id" class="form-select @error('vehicle_type_id') is-invalid @enderror">
                                <option value="">-- Select Vehicle Type --</option>
                                @foreach($vehicleTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                @endforeach
                            </select>
                            @error('vehicle_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Register Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Register</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery to Show/Hide Vehicle Type -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#group_id').on('change', function () {
                var selectedRole = $(this).find('option:selected').text().trim();
                if (selectedRole === 'Driver') {
                    $('#vehicleTypeSection').show();
                    $('#vehicle_type_id').prop('required', true);
                } else {
                    $('#vehicleTypeSection').hide();
                    $('#vehicle_type_id').prop('required', false);
                }
            });
        });
    </script>
@endsection
