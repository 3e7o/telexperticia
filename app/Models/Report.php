<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Report extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'medical_board_id',
        'record',
        'evaluation',
        'diagnosis',
        'recommendations',
    ];

    protected $searchableFields = ['*'];

    protected $appends = ['approved'];

    public function medicalBoard()
    {
        return $this->belongsTo(MedicalBoard::class);
    }

    /**
     * @param int $medicalBoardId
     * @return void
     */
    public static function createReport(int $medicalBoardId) : void
    {
        self::create([
            'record' => '',
            'evaluation' => '',
            'diagnosis' => '',
            'recommendations' => '',
            'medical_board_id' => $medicalBoardId,
        ]);
    }

    public function scopeItIsAuthorized(Builder $query)
    {
        $user = auth()->user();
        $doctorId = optional($user->doctor)->id;
        $patientId = optional($user->patient)->id;

        return $query
            ->join('medical_boards', 'reports.medical_board_id', '=', 'medical_boards.id')
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

    public function scopeItRecords(Builder $query, $patientId)
    {

        return $query
            ->join('medical_boards', 'reports.medical_board_id', '=', 'medical_boards.id')
            ->when(isset($patientId), function ($query) use ($patientId) {
                $query->where('medical_boards.patient_id', $patientId);
            });
    }

    public function getApprovedAttribute()
    {
        $medicalBoardId = $this->medicalBoard->id;
        $approved = Collect(DB::table('doctor_medical_board')
            ->where('medical_board_id', $medicalBoardId)
            ->pluck('approved'));
        $total = $approved->count();
        $sum = $approved->sum();

        return $total === $sum ? 'Aprobado' : 'No aprobado';
    }
}
