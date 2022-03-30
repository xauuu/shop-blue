<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $primaryKey = 'coupon_id';
    protected $fillable = [
        'coupon_name',
        'coupon_code',
        'coupon_times',
        'coupon_feature',
        'coupon_number'
    ];
    public $timestamps = true;
}
