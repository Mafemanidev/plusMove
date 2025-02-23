<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $fillable = [
        'weight', 'num_packages', 'warehouse_id', 'to_address', 'driver_id', 'tracking_code'
    ];

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function driver() {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function trackingDetails() {
        return $this->hasMany(TrackingDetail::class);
    }
}
