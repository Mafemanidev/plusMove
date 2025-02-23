<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Order;
use App\Models\Delivery;
use App\Models\TrackingDetail;
class DashboardController extends Controller {
    public function index() {
        // Get Driver Group ID safely
        $driverGroupId = Group::where('name', 'Driver')->value('id');

        // Count Orders that are NOT assigned a driver
        $totalOrders = Order::whereNull('driver_id')->count();

        // Count Orders that HAVE a driver assigned (Pending Deliveries)
        $pendingDeliveries = Order::whereNotNull('driver_id')->count();

        // Count Total Drivers
        $totalDrivers = $driverGroupId ? User::where('group_id', $driverGroupId)->count() : 0;

        return view('dashboard', compact('totalOrders', 'totalDrivers', 'pendingDeliveries'));
    }
}



