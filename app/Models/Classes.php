<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    // Relationships
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function studyYear()
    {
        return $this->belongsTo(StudyYear::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
