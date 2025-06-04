<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'birth_date',
        'role',
        'avatar_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //relations 
    
    public function courses(){
        return $this->hasMany(Course::class,"teacher_id");
    }

    public function registrations(){
        return $this->hasMany(Registration::class, "student_id");
    }

    public function coursesAsStudent(){
        return $this->belongsToMany(Course::class,"registrations","student_id","course_id")
                    ->withPivot(["registration_date","date_completed","progress","is_active","certificate_generated","certificate_url"])
                    ->withTimestamps();
    }

    public function events(){
        return $this->hasMany(Event::class, "created_by");
    }

    public function forums(){
        return $this->hasMany(Forum::class,"created_by");
    }

    public function forumTopics() {
        return $this->hasMany(ForumTopic::class, "author_id");
    }

    public function forumReplies(){
        return $this->hasMany(ForumReply::class, "author_id");
    }
    // jwt
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
