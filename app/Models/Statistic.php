<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;
    protected $table = 'statistics';
    protected $primaryKey = 'statistic_id';
    protected $fillable = [
        'order_date',
        'sales',
        'quantity',
        'total_order'
    ];
    public $timestamps = false;
}
