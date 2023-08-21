<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = ['name'];
    public $translatedAttributes = ['name'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_sub_categories');
    }

    public function instructors() {
        return $this->belongsToMany(Instructor::class, 'sub_category_instructors');
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
