<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = ['image', 'title', 'description'];
    public $translatedAttributes = ['title', 'description'];
}
