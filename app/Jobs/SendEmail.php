<?php

namespace App\Jobs;

use App\Mail\test;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Cart;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $details;
    public $rev;
    public $name;
    public $phone;
    public $address;
    public $coupon;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details, $rev, $name, $phone, $address, $coupon)
    {
        $this->details = $details;
        $this->rev = $rev;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
        $this->coupon = $coupon;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         Mail::to($this->rev)->send(new test($this->details, $this->name, $this->phone, $this->address, $this->coupon));
    }
}
