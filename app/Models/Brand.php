<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $primaryKey = 'brand_id';
    protected $fillable = [
        'brand_name',
        'brand_slug',
        'brand_desc',
        'brand_status'
    ];
    public $timestamps = true;
    public function count_brand()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
