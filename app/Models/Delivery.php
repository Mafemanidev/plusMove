<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'driver_id',
        'latitude',
        'longitude',
        'status'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function driver() {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function trackingDetails() {
        return $this->hasMany(TrackingDetail::class, 'order_id', 'order_id');
    }
}
