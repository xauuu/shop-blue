<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    protected $table = 'post_comments';
    protected $primaryKey = 'post_comment_id';
    protected $fillable = [
        'post_id',
        'customer_id',
        'post_comment_content',
        'post_comment_time'
    ];
    public $timestamps = true;
    function customer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
