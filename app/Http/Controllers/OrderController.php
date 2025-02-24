<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Warehouse;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\TrackingDetail;
use App\Mail\OrderCreated;
use App\Mail\OrderCreatedRecipientMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller {
    //Show All Orders
    public function index() {
        $orders = Order::with('warehouse', 'driver')->get();
        return view('orders.adminOrders', compact('orders'));
    }

    // Show Order Creation Form
    public function create() {
        $warehouses = Warehouse::all();
        $drivers = User::whereHas('group', function ($query) {
            $query->where('name', 'Driver');
        })->get();

        return view('orders.createOrder', compact('warehouses', 'drivers'));
    }

    //Store New Order
    public function store(Request $request) {
        $request->validate([
            'weight' => 'required|numeric|min:0.1',
            'num_packages' => 'required|integer|min:1',
            'warehouse_id' => 'required|exists:warehouses,id',
            'to_address' => 'required|string|max:255',
            'driver_id' => 'nullable|exists:users,id',
            'recipient_name' => 'required|string',
            'recipient_email' => 'required|email'
        ]);

        $trackingCode = Str::random(10);

        $order = Order::create([
            'weight' => $request->weight,
            'num_packages' => $request->num_packages,
            'warehouse_id' => $request->warehouse_id,
            'to_address' => $request->to_address,
            'tracking_code' => $trackingCode,
            'driver_id' => $request->driver_id,
            'recipient_name' => $request->recipient_name,
            'recipient_email' => $request->recipient_email,
        ]);


        TrackingDetail::create([
            'order_id' => $order->id,
            'status' => 'Order Created',
            'message' => 'The order has been created and is awaiting processing.'
        ]);

        //Send email to assigned driver
        if ($order->driver) {
            Mail::to($order->driver->email)->send(new OrderCreated($order));
        }

        // Send email notification to recipient
        if ($order->recipient_email) {
            Mail::to($order->recipient_email)->send(new OrderCreatedRecipientMail($order));
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    public function edit($id) {
        $order = Order::findOrFail($id);
        $warehouses = Warehouse::all();
        $drivers = User::whereHas('group', function ($query) {
            $query->where('name', 'Driver');
        })->get();

        return view('orders.edit', compact('order', 'warehouses', 'drivers'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'weight' => 'required|numeric|min:0.1',
            'num_packages' => 'required|integer|min:1',
            'warehouse_id' => 'required|exists:warehouses,id',
            'to_address' => 'required|string|max:255',
            'driver_id' => 'nullable|exists:users,id'
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    public function destroy($id) {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
}
