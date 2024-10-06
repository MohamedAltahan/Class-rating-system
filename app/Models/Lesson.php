<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'track_id', 'material_id', 'teacher_id', 'date_time', 'status'];


    public function ratings()
    {
        return $this->hasMany(Rating::class, 'lesson_id', 'id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }
}
