<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use App\Traits\Encryptable;
use Illuminate\Support\Str;

class AccessmUser extends AuthenticatableUser implements AuthenticatableContract, CanResetPasswordContract, MustVerifyEmail
{
    protected $table = 'Access_m_User';

    use Authenticatable, CanResetPassword, Notifiable, Encryptable;

    protected $encryptable = ['roleid', 'name', 'email'];
    protected $fillable = ['name', 'email', 'password', 'uniquecode', 'username', 'roleid'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function getEmailForPasswordReset()
    {
        return $this->username;
    }

    public function routeNotificationFor($driver, $notification = null)
    {
        if (method_exists($this, $method = 'routeNotificationFor'.Str::studly($driver))) {
            return $this->{$method}($notification);
        }

        switch ($driver) {
            case 'database':
                return $this->notifications();
            case 'mail':
                return $this->username;
            case 'nexmo':
                return $this->phone_number;
        }
    }

    public function sendEmailVerificationNotification()
    {
//
    }
}
