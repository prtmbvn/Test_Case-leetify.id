<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceHistory;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    /** ================== Resource minimal ================== */

    // Pakai tampilan log sebagai index (list) supaya konsisten requirement
    public function index(Request $request)
    {
        return $this->logs($request);
    }

    public function show(Attendance $attendance)
    {
        $attendance->load([
            'employee:employee_id,name,department_id',
            'employee.department:id,department_name',
            'histories' => fn($q) => $q->orderBy('date_attendance')
        ]);

        return view('attendance.show', compact('attendance'));
    }

    // Kalau admin mau hapus record attendance
    public function destroy(Attendance $attendance)
    {
        $attendance->delete(); // FK CASCADE akan hapus histories
        return redirect()->route('attendance.logs')->with('ok', 'Record attendance dihapus.');
    }

    /** ================== Aksi Check-in / Check-out ================== */

    public function showCheckIn()
    {
        // ambil list karyawan (dropdown)
        $employees = \App\Models\Employee::orderBy('name')->get(['employee_id','name']);
        return view('attendance.check-in', compact('employees'));
    }

    public function checkIn(Request $request)
    {
        $data = $request->validate(['employee_id' => 'required|exists:employee,employee_id']);
        $now  = now();

        $exists = Attendance::where('employee_id',$data['employee_id'])
            ->whereDate('clock_in', $now->toDateString())
            ->exists();
        if ($exists) return back()->withErrors('Sudah check-in hari ini.');

        $attendance = Attendance::create([
            'employee_id'   => $data['employee_id'],
            'attendance_id' => (string) Str::uuid(),
            'clock_in'      => $now,
        ]);

        AttendanceHistory::create([
            'employee_id'     => $data['employee_id'],
            'attendance_id'   => $attendance->attendance_id,
            'date_attendance' => $now,
            'attendance_type' => 1,
            'description'     => 'check-in',
        ]);

        return back()->with('ok', 'Check-in berhasil.');
    }

    public function showCheckOut()
    {
        $employees = \App\Models\Employee::orderBy('name')->get(['employee_id','name']);
        return view('attendance.check-out', compact('employees'));
    }

    public function checkOut(Request $request)
    {
        $data = $request->validate(['employee_id' => 'required|exists:employee,employee_id']);
        $now  = now();

        $attendance = Attendance::where('employee_id',$data['employee_id'])
            ->whereDate('clock_in', $now->toDateString())
            ->whereNull('clock_out')
            ->latest('clock_in')
            ->first();

        if (!$attendance) return back()->withErrors('Belum check-in atau sudah check-out.');

        $attendance->update(['clock_out'=>$now]);

        AttendanceHistory::create([
            'employee_id'     => $data['employee_id'],
            'attendance_id'   => $attendance->attendance_id,
            'date_attendance' => $now,
            'attendance_type' => 2,
            'description'     => 'check-out',
        ]);

        return back()->with('ok', 'Check-out berhasil.');
    }

    /** ================== Logs (ketepatan) ================== */

    public function logs(Request $request)
    {
        $request->validate([
            'date_from'     => 'nullable|date',
            'date_to'       => 'nullable|date',
            'department_id' => 'nullable|integer|exists:department,id',
            'employee_id'   => 'nullable|string|exists:employee,employee_id',
        ]);

        $q = Attendance::query()
            ->join('employee as e','e.employee_id','=','attendance.employee_id')
            ->join('department as d','d.id','=','e.department_id')
            ->selectRaw("
                attendance.id,
                attendance.attendance_id,
                DATE(attendance.clock_in) as date,
                e.employee_id, e.name as employee_name, d.department_name as department,
                attendance.clock_in, attendance.clock_out,
                CASE WHEN TIME(attendance.clock_in) <= d.max_clock_in_time THEN 'ON_TIME' ELSE 'LATE' END as check_in_status,
                GREATEST(0, TIMESTAMPDIFF(MINUTE, CONCAT(DATE(attendance.clock_in),' ', d.max_clock_in_time), attendance.clock_in)) as late_minutes,
                CASE
                  WHEN attendance.clock_out IS NULL THEN 'MISSING'
                  WHEN TIME(attendance.clock_out) >= d.max_clock_out_time THEN 'COMPLETE'
                  ELSE 'EARLY_LEAVE'
                END as check_out_status,
                GREATEST(0, TIMESTAMPDIFF(MINUTE, attendance.clock_out, CONCAT(DATE(attendance.clock_out),' ', d.max_clock_out_time))) as early_minutes,
                TIMESTAMPDIFF(MINUTE, attendance.clock_in, COALESCE(attendance.clock_out, NOW())) as work_minutes
            ");

        if ($request->filled('date_from'))     $q->whereDate('attendance.clock_in','>=',$request->date_from);
        if ($request->filled('date_to'))       $q->whereDate('attendance.clock_in','<=',$request->date_to);
        if ($request->filled('department_id')) $q->where('d.id',$request->department_id);
        if ($request->filled('employee_id'))   $q->where('e.employee_id',$request->employee_id);

        $rows = $q->orderByDesc('attendance.clock_in')->paginate(20)->withQueryString();
        $departments = Department::orderBy('department_name')->get(['id','department_name']);

        // Reuse view logs
        return view('attendance.logs', compact('rows','departments'));
    }
}
