<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class, "category_courses", 'course_id', 'category_id');
    }
    public function lessons() : HasMany 
    {
        return $this->hasMany(Lesson::class, "course_id");
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
