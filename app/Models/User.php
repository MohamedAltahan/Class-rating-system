<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'phone',
        'image',
        'status',
        'role',
        'studing_status',
        'birth_place',
        'birth_date',
        'nationality',
        'residence_number',
        'residence_date',
        'class',
        'parent_name',
        'landline_number',
        'address',
        'description',
        'email_verified_at',
        'password',
        'track_id',
        'class_room_id',
        'class_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function teacherMaterials()
    {
        return $this->belongsToMany(Material::class, 'material_teacher', 'teacher_id', 'material_id', 'id', 'id');
    }

    public function studentMaterials()
    {
        return $this->belongsToMany(Material::class, 'material_student', 'student_id', 'material_id', 'id', 'id');
    }
}
