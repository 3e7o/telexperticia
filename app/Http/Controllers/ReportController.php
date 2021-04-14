<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\MedicalBoard;
use App\Http\Requests\ReportStoreRequest;
use App\Http\Requests\ReportUpdateRequest;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Report::class);

        $search = $request->get('search', '');

        $reports = Report::query()
            ->itIsAuthorized()
            ->groupBy('id')
            ->orderBy('reports.id', 'DESC')
            ->select('reports.*')
            ->paginate(0);

        return view('app.reports.index', compact('reports', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Report::class);

        $medicalBoards = MedicalBoard::pluck('id', 'id');

        return view('app.reports.create', compact('medicalBoards'));
    }

    /**
     * @param \App\Http\Requests\ReportStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportStoreRequest $request)
    {
        $this->authorize('create', Report::class);

        $validated = $request->validated();

        $report = Report::create($validated);

        return redirect()
            ->route('reports.edit', $report)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Report $report)
    {
        $this->authorize('view', $report);

        $isSupervisor = false;
        $approved = false;
        if (auth()->user()->isDoctor()) {
            $isSupervisor = $report
                ->medicalBoard
                ->doctorsSupervisors
                ->pluck('user_id')
                ->contains(auth()->user()->id);
        }

        if ($isSupervisor) {
            $medicalBoardId = $report->medicalBoard->id;
            $doctorId = auth()->user()->doctor->id;
            $approved = DB::table('doctor_medical_board')
                ->where('doctor_id', $doctorId)
                ->where('medical_board_id', $medicalBoardId)
                ->first()->approved;
        }

        return view('app.reports.show', compact('report', 'isSupervisor', 'approved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Report $report)
    {
        $this->authorize('update', $report);

        $medicalBoards = MedicalBoard::pluck('id', 'id');

        return view('app.reports.edit', compact('report', 'medicalBoards'));
    }

    /**
     * @param \App\Http\Requests\ReportUpdateRequest $request
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function update(ReportUpdateRequest $request, Report $report)
    {
        $this->authorize('update', $report);

        $validated = $request->validated();

        $report->update($validated);

        return redirect()
            ->route('reports.edit', $report)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Report $report)
    {
        $this->authorize('delete', $report);

        $report->delete();

        return redirect()
            ->route('reports.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function download(Report $report)
    {
        $this->authorize('view-any', Report::class);

        $medicalBoard = $report->medicalBoard;
        $patient = $medicalBoard->patient;
        $doctorOwner = $medicalBoard->doctorOwner;
        $doctorsSupervisors = $medicalBoard->doctorsSupervisors;
        $fileName = 'Informe - ' . $medicalBoard->code . '.pdf';

        return \PDF::loadView('reports.report-pdf', compact('report', 'medicalBoard', 'patient', 'doctorOwner', 'doctorsSupervisors'))
            ->setPaper('a4')
            ->stream($fileName);
//            ->download($fileName);
    }

    public function approve(Report $report)
    {
        $medicalBoardId = $report->medicalBoard->id;
        $doctorId = auth()->user()->doctor->id;

        DB::table('doctor_medical_board')
            ->where('doctor_id', $doctorId)
            ->where('medical_board_id', $medicalBoardId)
            ->update([
                'approved' => true
            ]);

        return back();
    }
}
