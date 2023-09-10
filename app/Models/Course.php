<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = ['name', 'description', 'image', 'category_id', 'instructor_id'];
    public $translatedAttributes = ['name', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function videos() {
        return $this->hasMany(Video::class);
    }
}
