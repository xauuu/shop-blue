<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Product;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $primaryKey = 'order_detail_id';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_price',
        'quantity'
    ];
    public $timestamps = true;
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
