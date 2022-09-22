<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;

use App\Notifications\UserMail;
use App\Notifications\MailResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    const ACCESS_ADMIN = 1;
    const ACCESS_USER = 2;
    const ACCESS_ADMINUNIT = 3;
    const ACCESS_ADMINKEU = 4;
    const ACCESS_PSIKOTES = 5;
    const ACCESS_PENGADAAN = 6;

    use HasApiTokens, Notifiable;

    public function sendPasswordResetNotification($token)
    {
        // $this->notify(new MailResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        // $this->notify(new UserMail);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'level', 'unit', 'force_change', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'password', 'remember_token', 'level', 'unit', 'force_change'
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

    public function isAdministrator()
    {
        return $this->id == 1;
    }

    public function isHaveAccess($akses)
    {
        return in_array($this->level, $akses);
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

    public function isPsikotes()
    {
        return $this->level == static::ACCESS_PSIKOTES;
    }

    public function isPengadaan()
    {
        return $this->level == static::ACCESS_PENGADAAN;
    }

    public function calons()
    {
        return $this->hasMany(Calon::class, 'user_id');
    }

    public static function email($id)
    {
        return static::where('id', $id)->first()->email;
    }

    public static function namaUser($id)
    {
        return static::where('id', $id)->first()->name;
    }
}
