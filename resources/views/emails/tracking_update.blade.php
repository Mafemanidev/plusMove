<!DOCTYPE html>
<html>
<head>
    <title>Package Tracking Update</title>
</head>
<body>
<p>Dear {{ $order->recipient_name }},</p>

<p>Your package status has been updated.</p>

<h3>Tracking Code: {{ $order->tracking_code }}</h3>
<p>Current Status: <strong>{{ $trackingDetail->status }}</strong></p>

<p>We will keep you updated as your package progresses.</p>

<p>Best Regards,<br>PlusMove Team</p>
</body>
</html>
