<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = ['name', 'description', 'image', 'sub_category_id'];
    public $translatedAttributes = ['name', 'description', 'image', 'sub_category_id'];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function videos() {
        return $this->hasMany(Video::class);
    }
}
