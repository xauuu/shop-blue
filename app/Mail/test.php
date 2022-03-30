<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Cart;

class test extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $name, $phone, $address, $coupon)
    {
        $this->details = $details;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
        $this->coupon = $coupon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('qdatqb@gmail.com')
        ->subject('BLUE Shop. Đặt hàng thành công.')
        ->markdown('emails.test')
        ->with('details', $this->details)
        ->with('name', $this->name)
        ->with('phone', $this->phone)
        ->with('address', $this->address)
        ->with('coupon', $this->coupon);

    }
}
?>
