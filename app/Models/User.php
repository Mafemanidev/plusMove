<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Group;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'group_id',
    ];

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function vehicleType() {
        return $this->belongsTo(VehicleType::class);
    }

    public function getProfilePictureUrlAttribute() {
        return $this->profile_picture
            ? asset('storage/' . $this->profile_picture)
            : asset('images/default-profile.png');
    }

    public function hasGroup($groupName) {
        return $this->group && $this->group->name === $groupName;
    }
}
