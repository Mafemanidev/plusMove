<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderCreated extends Mailable {
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    public function build() {
        return $this->subject('New Order Assigned')->view('emails.orderCreated');
    }
}
