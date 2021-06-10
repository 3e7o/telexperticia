<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $table = 'records';
    public $timestamps = true;

    protected $fillable = [ 'record_familiar',
                            'record_clinic',
                            'blood_type',
                            'status',
                            'id_user_create',
                            'id_userupdate'
                        ];

    public function recordAllergies()
    {
        return $this->belongsToMany(Parameter::class, 'allergies', 'record_id', 'parameter_id')->withTimestamps();
    }

    public function createRecord($record) : int
    {
        $recordCreated = Record::factory()
        ->create([
            'record_familiar' => '',
        ]);

    return $recordCreated->id;
    }

    public function recordVaccines()
    {
        return $this->belongsToMany(Parameter::class, 'vaccines', 'record_id', 'parameter_id')->withTimestamps();
    }

    public function recordOperations()
    {
        return $this->belongsToMany(Parameter::class, 'operations', 'record_id', 'parameter_id')->withTimestamps();
    }

    public function hasAllergies($allergie)
    {

        $posts = Record::has('$allergie')->get();
        if(isset($posts)){
        return true;
        }
    }

}
