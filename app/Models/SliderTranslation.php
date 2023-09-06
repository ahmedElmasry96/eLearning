<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'slogan', 'title', 'paragraph', 'button_title'];
    public $timestamps = false;
}
