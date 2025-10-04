<?php

namespace App\Http\Controllers;

use App\Models\AttendanceHistory;
use Illuminate\Http\Request;

class AttendanceHistoryController extends Controller
{
    public function index(Request $request)
    {
        $histories = AttendanceHistory::query()
            ->when($request->filled('employee_id'), fn($q) =>
                $q->where('employee_id', $request->employee_id)
            )
            ->when($request->filled('attendance_id'), fn($q) =>
                $q->where('attendance_id', $request->attendance_id)
            )
            ->when($request->filled('type'), fn($q) =>
                $q->where('attendance_type', (int) $request->type) 
            )
            ->when($request->filled('date_from'), fn($q) =>
                $q->whereDate('date_attendance', '>=', $request->date_from)
            )
            ->when($request->filled('date_to'), fn($q) =>
                $q->whereDate('date_attendance', '<=', $request->date_to)
            )
            ->orderByDesc('date_attendance')
            ->paginate(20)
            ->withQueryString();

        return view('attendance_histories.index', compact('histories'));
    }

    public function show(AttendanceHistory $attendance_history)
    {
        return view('attendance_histories.show', ['history' => $attendance_history]);
    }

   
    public function create()  { abort(404); }
    public function store(Request $r) { abort(404); }
    public function edit(AttendanceHistory $attendance_history) { abort(404); }
    public function update(Request $r, AttendanceHistory $attendance_history) { abort(404); }

    public function destroy(AttendanceHistory $attendance_history)
    {
        $attendance_history->delete();
        return back()->with('ok','History dihapus.');
    }
}
