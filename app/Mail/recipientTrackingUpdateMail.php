<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\TrackingDetail;
use App\Models\Order;

class recipientTrackingUpdateMail extends Mailable {
    use Queueable, SerializesModels;

    public $trackingDetail;
    public $order;

    public function __construct(TrackingDetail $trackingDetail, Order $order) {
        $this->trackingDetail = $trackingDetail;
        $this->order = $order;
    }

    public function build() {
        return $this->to($this->order->recipient_email)
        ->subject('Your Package Tracking Update')
            ->view('emails.tracking_update')
            ->with([
                'order' => $this->order,
                'trackingDetail' => $this->trackingDetail
            ]);
    }
}

