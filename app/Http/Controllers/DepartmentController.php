<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::query()
            ->when($request->filled('search'), fn($q) =>
                $q->where('department_name', 'like', '%' . $request->search . '%')
            )
            ->orderBy('department_name')
            ->paginate(10)
            ->withQueryString();

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'department_name'  => 'required|string|max:255',
            'max_clock_in_time' => 'required|date_format:H:i',
            'max_clock_out_time'=> 'required|date_format:H:i',
        ]);

        Department::create($data);

        return redirect()->route('departments.index')->with('ok', 'Departemen dibuat.');
    }

    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $data = $request->validate([
            'department_name'  => 'required|string|max:255',
            'max_clock_in_time' => 'required|date_format:H:i',
            'max_clock_out_time'=> 'required|date_format:H:i',
        ]);

        $department->update($data);

        return redirect()->route('departments.index')->with('ok', 'Departemen diperbarui.');
    }

    public function destroy(Department $department)
    {
        // FK RESTRICT di migration akan mencegah delete jika masih dipakai employee
        $department->delete();
        return redirect()->route('departments.index')->with('ok', 'Departemen dihapus.');
    }
}
