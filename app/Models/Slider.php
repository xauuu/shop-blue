<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'sliders';
    protected $primaryKey = 'slider_id';
    protected $fillable = [
        'slider_img',
        'slider_title',
        'slider_name',
        'slider_content',
        'slider_discount'
    ];
    public $timestamps = false;
}
