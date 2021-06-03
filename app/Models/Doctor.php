<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Doctor extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'signature',
        'regional_id',
        'specialty_id',
        'signature',
    ];

    public $appends = [
        'fullName'
    ];

    protected $searchableFields = ['*'];

    protected static function boot() :void
    {
        parent::boot();

        self::creating(function ($table) {
            $table->user_id = (new User())->createUser($table, 'Medico');
        });

        self::updating(function ($table) {
            (new User())->updateUser($table);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function medicalBoardsOwner()
    {
        return $this->hasMany(MedicalBoard::class);
    }

    public function medicalBoardsSupervisor()
    {
        return $this->belongsToMany(MedicalBoard::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->first_surname} ({$this->specialty->name})";
    }
}
