<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $primaryKey = 'rating_id';
    protected $fillable = [
        'product_id',
        'customer_id',
        'rating'
    ];
    public $timestamps = true;
}
