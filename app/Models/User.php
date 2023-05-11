<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Type\Integer;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Вставка нового пользователя
     * @param $email     String логин пользователя
     * @param $password  String пароль пользователя
     * @param $role      Integer роль
     * @return array
     */
    public function createUser($email, $password, $role) : array
    {
        $result = DB::table('users')
            ->insert([
                'email' => $email,
                'password' => $password,
                'User_Role' => $role,
                'created_at' => Carbon::now()
            ]);
    if ($result == 1) {
        return [
          'success' => true,
          'msg' => 'Пользователь создан'
        ];
    } else {
        return [
            'success' => true,
            'error_msg' => 'Пользователь не создан. Произошла ошибка!'
        ];
    }
    }

    public function isUserExists($email) : ?bool
    {
        $count = DB::table('users')->where('email', '=', $email)->count();
        switch ($count) {
            case 0:
                return false;
            case 1:
                return true;
            default:
                return null;
        }

    }
}
