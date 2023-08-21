<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'phone', 'age', 'image'];

    public function subCategories() {
        return $this->belongsToMany(SubCategory::class, 'sub_category_instructors');
    }
}
