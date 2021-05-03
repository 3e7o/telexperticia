<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasFactory;
    use Searchable;
    use HasApiTokens;

    protected $fillable = ['name', 'username', 'email', 'password'];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $types = [
        'Usuario' => 'Usuario',
        'Medico' => 'Medico',
        'Paciente' => 'Paciente',
    ];

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }

    public function isDoctor()
    {
        return $this->hasRole('medico');
    }

    /**
     * @param $user
     * @param $type
     * @return int
     */
    public function createUser($user, $type) : int
    {
        $password = Str::random(8);
        $userCreated = User::factory()
            ->create([
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username,
                'password' => bcrypt($password)
            ]);

        $userCreated->assignRole($type);

        $this->sendMailUserCreated($userCreated, $password, $type);

        return $userCreated->id;
    }

    public function sendMailUserCreated($userCreated, $password, $type)
    {
        sleep(1);
        $name = $userCreated->fullName;
        $email = $userCreated->email;
        $userType = $this->types[$type];

        //Mail::send('mails.user-created', compact('name', 'email', 'password', 'userType'), function($message) use ($email) {
       //     $message->from('no-reply@telexperticia.com', 'Administración');
       //     $message->subject('Notificación de creación de usuario.');
       //     $message->to($email);
       // });
    }

    public function updateUser($user) : void
    {
        User::where('id', $user->user_id)
            ->update([
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email
            ]);
    }

    /**
     * @return void
     */
    public function updateRelatedEntity() : void
    {
        foreach ($this->types as $type) {
            if (isset($this->{$type})) {
                $this->{$type}->update([
                    'name' => $this->name,
                    'email' => $this->email,
                ]);
            }
        }
    }
}
