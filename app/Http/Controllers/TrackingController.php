<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\TrackingDetail;

class TrackingController extends Controller {
    public function show($trackingCode) {
        $order = Order::where('tracking_code', $trackingCode)->firstOrFail();
        $trackingDetails = $order->trackingDetails()->orderBy('created_at', 'asc')->get();

        return view('tracking.show', compact('order', 'trackingDetails'));
    }
}

