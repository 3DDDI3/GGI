<?php

namespace App\Models\User;

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
        'email',
        'lastname',
        'password',
        'middlename',
        'client_card',
        'client_type'
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

    //проверка на админа
    public function isAdmin()
    {
        return $this->is_admin === 1;
    }

    //получить ФИО или логин
    public function getName()
    {
        $name = trim($this->name . ' ' . $this->lastname . ' ' . $this->middlename);
        if (empty($name)) $name = $this->getEmail();

        $id = $this->id ?? '';

        if ($name == 'name' . $id) $name = '';

        return $name;
    }

    //получить Email
    public function getEmail()
    {

        $email = $this->email;
        $id = $this->id;

        //при входе через телефон email по id автоматом, поэтмоу доп. проверка
        if ($email == 'email' . $id) $email = '';

        return $email;
    }

    //получить ФИО или логин
    public static function getAdminLink($user_id, $show_user_name = false)
    {

        if (empty($user_id)) return;

        $login = '';
        $self = self::where('id', $user_id)->first();
        if ($self) {
            $login = $self->email;
            if ($show_user_name) {
                $name = trim($self->name . ' ' . $self->lastname . ' ' . $self->middlename);
                if (!empty($name) && $login <> $name) $login .= ' - ' . $name;
            }
            $login = "<a class='admin-link' href='/admin/users/edit/{$user_id}' target='_blank'>{$login}</a>";
        }

        return $login;
    }

    public function user_class()
    {
        return $this->belongsTo(UserСlasses::class, 'class_id');
    }
}
