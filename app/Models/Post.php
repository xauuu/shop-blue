<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    protected $fillable = [
        'category_post_id',
        'post_title',
        'post_slug',
        'post_img',
        'post_desc',
        'post_detail',
        'post_meta_keywords',
        'post_meta_desc',
        'post_status'
    ];
    public $timestamps = true;
    public function category()
    {
        return $this->belongsTo(CategoryPost::class, 'category_post_id');
    }

    public function next()
    {
        return $this->hasOne(Post::class, 'category_post_id', 'category_post_id')->where('post_id', '>', $this->post_id)->take(1);
    }

    public function prev()
    {
        return $this->hasOne(Post::class, 'category_post_id', 'category_post_id')->where('post_id', '<', $this->post_id)->latest()->take(1);
    }
    public function comment()
    {
        return $this->hasMany(PostComment::class, 'post_id');
    }
}
