<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sale';
    protected $primaryKey = 'sale_id';
    protected $fillable = [
        'product_id',
        'sale_name',
        'sale_img',
        'sale_time',
        'sale_percent',
        'sale_status'
    ];
    public $timestamps = false;
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
