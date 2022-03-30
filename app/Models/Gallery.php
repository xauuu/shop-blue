<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galleries';
    protected $primaryKey = 'gallery_id';
    protected $fillable = [
        'gallery_img',
        'product_id'
    ];
    public $timestamps = true;
}
