<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ["created_at", "updated_at"];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, "category_courses", 'category_id', 'course_id');
    }
}
