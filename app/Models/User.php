<?php

namespace App\Models;

use App\Jobs\VerifyEmailJob;
use App\Observers\UserObserver;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable  
{
    use HasFactory, Notifiable;

    public function sendEmailVerificationNotification(){
        VerifyEmailJob::dispatch($this);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'dob'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //accessor
    public function getNameMobileAttribute(){
        return $this->name . '-' . $this->mobile;
    }

    //mutator
    public function setNameAttribute($value){
        $this->attributes['name'] =  strtoupper($value);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role){
        return $this->roles->where('slug',$role)->count() > 0;
    }

    public function hasAnyRole($roles){
        foreach($roles as $role){
            if($this->hasRole($role)){
                return true;
            }
        }
        return false;
    }
}
