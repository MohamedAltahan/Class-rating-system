<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'track_id'
    ];

    public function track()
    {
        return $this->belongsTo(track::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Lesson::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'material_teacher', 'material_id', 'teacher_id')->where('role', 'teacher');
    }
}
