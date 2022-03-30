<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';
    protected $fillable = [
        'product_id',
        'customer_id',
        'comment_content',
        'comment_time',
        'reply_id'
    ];
    public $timestamps = true;
    function customer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
