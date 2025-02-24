<!DOCTYPE html>
<html>
<head>
    <title>Your Delivery is On the Way!</title>
</head>
<body>
<p>Dear {{ $order->recipient_name }},</p>

<p>Your order has been successfully created. You can track your package using the tracking code:</p>

<h3>{{ $order->tracking_code }}</h3>

<p>Destination Address: <strong>{{ $order->to_address }}</strong></p>

<p>Thank you for using PlusMove. We will keep you updated on your delivery status.</p>

<p>Best Regards,<br>PlusMove Team</p>
</body>
</html>
