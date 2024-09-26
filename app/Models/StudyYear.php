<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    // Relationships
    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
}
