<!DOCTYPE html>
<html>
<head>
    <title>New Order Assigned</title>
</head>
<body>
<h2>New Order Assigned to You</h2>
<p>Hello {{ $order->driver->name }},</p>
<p>A new order has been assigned to you.</p>
<p><strong>Tracking Code:</strong> {{ $order->tracking_code }}</p>
<p><strong>From:</strong> {{ $order->warehouse->name }}</p>
<p><strong>To:</strong> {{ $order->to_address }}</p>
<p>Click <a href="{{ route('tracking.show', $order->tracking_code) }}">here</a> to track the order.</p>
</body>
</html>
