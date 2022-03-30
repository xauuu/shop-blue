<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Social extends Model
{
    use HasFactory;
    protected $table = 'customer_socials';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'provider_user_id',
        'provider',
        'user',
    ];
    public $timestamps = false;

    public function login()
    {
        return $this->belongsTo('App\Models\Customer', 'user');
    }
}
