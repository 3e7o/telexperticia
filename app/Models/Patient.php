<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Patient extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'ci',
        'name',
        'email',
        'first_surname',
        'last_surname',
        'force',
        'address',
        'gender',
        'birthday',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'birthday' => 'date',
    ];

    public $appends = [
      'fullName', 'matricula'
    ];

    protected static function boot() :void
    {
        parent::boot();

        self::creating(function ($table) {
            $table->user_id = (new User())->createUser($table, 'Paciente');
        });

        self::updating(function ($table) {
            (new User())->updateUser($table);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicalBoards()
    {
        return $this->hasMany(MedicalBoard::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->first_surname}";
    }
    public function getMatriculaAttribute()
    {
        return $this->birthday->format('ymd').Str::substr($this->last_surname, 0, 1).Str::substr($this->last_surname, 0, 1).Str::substr($this->name, 0, 1);
    }
}
