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
        'signature',
        'regional_id',
        'specialty_id',
    ];

    public $appends = [
        'fullName'
    ];

    protected $searchableFields = ['*'];


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
        $name = optional($this->user)->name;
        $first_surname = optional($this->user)->first_surname;
        return "{$name} {$first_surname} ({$this->specialty->name})";
    }
}
