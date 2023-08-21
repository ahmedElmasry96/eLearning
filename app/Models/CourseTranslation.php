<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'image', 'sub_category_id'];
    public $timestamps = false;
}
