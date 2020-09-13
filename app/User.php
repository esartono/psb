<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\UserMail;
use App\Notifications\MailResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    const ACCESS_ADMIN = 1;
    const ACCESS_USER = 2;
    const ACCESS_ADMINUNIT = 3;
    const ACCESS_ADMINKEU = 4;

    use HasApiTokens, Notifiable;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new UserMail);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'level', 'unit'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'password', 'remember_token', 'level', 'unit'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'tpid', 'tpname'
    ];

    public function getTpIdAttribute()
    {
        $tp_aktif = TahunPelajaran::where('status', 1)->first();
        return $tp_aktif->id;
    }

    public function getTpNameAttribute()
    {
        $tp_aktif = TahunPelajaran::where('status', 1)->first();
        return $tp_aktif->name;
    }

    public function scopeAdmin($query)
    {
        return $query->where('level', static::ACCESS_ADMIN);
    }

    public function scopeUser($query)
    {
        return $query->where('level', static::ACCESS_USER);
    }

    public function isUser()
    {
        return $this->level == static::ACCESS_USER;
    }

    public function isAdmin()
    {
        return $this->level == static::ACCESS_ADMIN;
    }

    public function isAdminUnit()
    {
        return $this->level == static::ACCESS_ADMINUNIT;
    }

    public function isAdminKeu()
    {
        return $this->level == static::ACCESS_ADMINKEU;
    }

    public function calons()
    {
        return $this->hasMany(Calon::class, 'user_id');
    }

}
