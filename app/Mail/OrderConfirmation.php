<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $orders;
    public $products;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orders, $products)
    {
        $this->orders = $orders;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.order-confirmation')
                    ->subject('Order Confirmation');
    }
}
