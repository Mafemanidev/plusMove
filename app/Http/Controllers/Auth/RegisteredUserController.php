<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller {

    public function create() {
        $groups = Group::all();
        $vehicleTypes = VehicleType::all();
        return view('auth.register', compact('groups', 'vehicleTypes'));
    }

    public function store(Request $request) {
        // Retrieve the Driver group ID before validation
        $driverGroup = Group::where('name', 'Driver')->first();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'group_id' => ['required', 'exists:groups,id'],
            'vehicle_type_id' => [
                function ($attribute, $value, $fail) use ($request, $driverGroup) {
                    if ($driverGroup && $request->group_id == $driverGroup->id && !$value) {
                        $fail('The vehicle type field is required for drivers.');
                    }
                }
            ],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            if ($file->isValid()) {
                $profilePicturePath = $file->store('profile_pictures', 'public');
            }
        }

        // Ensure vehicle_type_id is only stored for Drivers
        $vehicleTypeId = ($driverGroup && $request->group_id == $driverGroup->id) ? $request->vehicle_type_id : null;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'group_id' => $request->group_id,
            'vehicle_type_id' => $vehicleTypeId,
            'profile_picture' => $profilePicturePath
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }
}
