<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_email',
        'customer_name',
        'customer_avatar',
        'customer_pass',
        'customer_status'
    ];
    public $timestamps = true;
}
