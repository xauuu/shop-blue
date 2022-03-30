<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Customer;
use  App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'customer_id',
        'shipping_id',
        'order_total',
        'order_payment',
        'order_status',
        'order_date'
    ];
    public $timestamps = true;
    public function shipping()
    {
        return $this->belongsTo('App\Models\Shipping', 'shipping_id');
    }

    public function order_detail()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id');
    }
}
