<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class MedicalBoard extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['date', 'status', 'patient_id', 'doctor_id'];

    protected $searchableFields = ['*'];

    protected $table = 'medical_boards';

    protected $casts = [
        'date' => 'datetime',
    ];

    public $appends = [
        'code',
        'identification'
    ];

    protected static function boot() :void
    {
        parent::boot();

        self::creating(function ($table) {
            $table->meet = Arr::random(Config::get('google-meet'));
        });

        self::created(function ($self) {
            if (!App::runningInConsole()) {
                Report::createReport($self->id);
            }
        });

        self::deleting(function ($self) {
            $self->doctorsSupervisors()->detach();
            $self->report->delete();
        });
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }

    public function doctorOwner()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function doctorsSupervisors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_medical_board', 'medical_board_id', 'doctor_id');
    }

    public function getCodeAttribute()
    {
        return str_pad($this->id,3,"0",STR_PAD_LEFT) . ' - ' . $this->created_at->format('Y');
    }

    public function getIdentificationAttribute()
    {
        return "{$this->code} | {$this->patient->fullName}";
    }

    public function scopeItIsAuthorized(Builder $query)
    {
        $user = auth()->user();
        $doctorId = optional($user->doctor)->id;
        $patientId = optional($user->patient)->id;

        return $query
            ->when(!$user->isSuperAdmin() && isset($doctorId), function ($query) use ($doctorId) {
                $query->join('doctor_medical_board', function($join) use ($doctorId) {
                    $join->on('medical_boards.id', '=', 'doctor_medical_board.medical_board_id')
                        ->where(function($where) use ($doctorId) {
                            $where->where('doctor_medical_board.doctor_id', '=', $doctorId)
                                ->orWhere('medical_boards.doctor_id', $doctorId);
                        });
                });
            })
            ->when(!$user->isSuperAdmin() && isset($patientId), function ($query) use ($patientId) {
                $query->where('medical_boards.patient_id', $patientId);
            });
    }

}
