<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = 'category_posts';
    protected $primaryKey = 'category_post_id';
    protected $fillable = [
        'category_post_name',
        'category_post_slug',
        'category_post_desc',
        'category_post_status'
    ];
    public $timestamps = true;
    public function count_post(){
        return $this->hasMany(Post::class,'category_post_id');
    }
}
