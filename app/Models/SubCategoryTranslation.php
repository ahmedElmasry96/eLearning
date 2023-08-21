<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id'];
    public $timestamps = false;
}