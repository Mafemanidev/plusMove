<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreatedRecipientMail;
use App\Mail\recipientTrackingUpdateMail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\TrackingDetail;
use App\Models\StatusProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DriverDashboardController extends Controller {

    public function index() {

        $driver = Auth::user();

        // Get orders assigned to the driver
        $orders = Order::where('driver_id', $driver->id)
            ->with(['warehouse', 'trackingDetails' => function ($query) {
                $query->latest();
            }])->get();

        return view('driver.dashboard', compact('orders'));
    }

    public function updateTracking(Request $request, $orderId) {
        $request->validate([
            'status' => 'required|exists:status_progress,id'
        ]);

        $order = Order::findOrFail($orderId);

        $trackingDetails = TrackingDetail::create([
            'order_id' => $order->id,
            'status' => StatusProgress::find($request->status)->name,
            'message' => $request->message ?? null,
        ]);

        // Send email updates to recipient
        if ($order->recipient_email) {
            Mail::to($order->recipient_email)->send(new recipientTrackingUpdateMail($trackingDetails, $order));
        }

        return redirect()->route('driver.dashboard')->with('success', 'Tracking status updated!');
    }
}

