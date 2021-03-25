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
    public static function areDoctorsAvailable ($doctors_id, $date, $medicalBoardId = null)
    {
        $doctor = [];
        $doctor['areNotAvailabe'] = false;
        foreach ($doctors_id as $doctor_id) {
            $doctor_temp = Doctor::find($doctor_id);
            $dates_1 = $doctor_temp->medicalBoardsOwner()
                ->when($medicalBoardId, function ($query) use ($medicalBoardId) {
                    $query->where('id', '<>', $medicalBoardId);
                })
                ->pluck('date');
            $dates_2 = $doctor_temp->medicalBoardsSupervisor()
                ->when($medicalBoardId, function ($query) use ($medicalBoardId) {
                    $query->where('id', '<>', $medicalBoardId);
                })
                ->pluck('date');
            $dates = $dates_1->merge($dates_2);
            $date = Carbon::parse($date);
            foreach ($dates as $start) {
                $end = (clone $start)->addMinutes(30);
                if ($date->between($start,$end)) {
                    $doctor['areNotAvailabe'] = true;
                    $doctor['name'] = $doctor_temp->fullName;
                    break;
                }
            }
            if ($doctor['areNotAvailabe']) break;
        }
        return $doctor;
    }

}
