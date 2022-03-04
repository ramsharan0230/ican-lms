<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\CustomUserTrait;


class User extends Authenticatable
{
    use CustomUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password', 'first_name', 'last_name', 'middle_name', 'role_id', 'description', 'active_status'
    ];

    protected $appends = ['full_name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value) {
        return $this->attributes['password'] = bcrypt($value);
    }

    public function role() {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    public function assigned_course() {
        return $this->belongsToMany('App\Models\Course', 'assign_courses', 'user_id', 'course_id')->withTimestamps();
    }

    public function test_results() {
        return $this->hasMany('App\Models\TestResult', 'user_id');
    }

    /**
     * Get Full Name for User
     */
    public function getFullNameAttribute()
    {
        if($this->middle_name != ""){
            return $this->first_name . " " . $this->middle_name . " " . $this->last_name;
        }
        return $this->first_name . " " . $this->last_name;
    }
}
