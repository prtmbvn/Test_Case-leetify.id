<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $department = Department::orderBy('department_name')->get(['id','department_name']);

        $employees = Employee::query()
            ->with('department:id,department_name')
            ->when($request->filled('department_id'), fn($q) =>
                $q->where('department_id', $request->department_id)
            )
            ->when($request->filled('search'), function ($q) use ($request) {
                $s = trim($request->search);
                $q->where(function ($qq) use ($s) {
                    $qq->where('name', 'like', "%$s%")
                       ->orWhere('employee_id', 'like', "%$s%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('employees.index', compact('employees','department'));
    }

    public function create()
    {
        $department = Department::orderBy('department_name')->get(['id','department_name']);
        $employee = Employee::all();
        return view('employees.create', compact('department','employee'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id'    => 'required|string|max:50|unique:employee,employee_id',
            'name'           => 'required|string|max:255',
            'department_id' => 'required|integer|exists:department,id',
            'address'        => 'nullable|string',
        ]);

        Employee::create($data);

        return redirect()->route('employees.index')->with('ok', 'Karyawan ditambahkan.');
    }

    public function show(Employee $employee)
    {
        $employee->load('department:id,department_name');
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $department = department::orderBy('department_name')->get(['id','department_name']);
        return view('employees.edit', compact('employee','department'));
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'employee_id'    => 'required|string|max:50|unique:employee,employee_id,' . $employee->id . ',id',
            'name'           => 'required|string|max:255',
            'department_id' => 'required|integer|exists:department,id',
            'address'        => 'nullable|string',
        ]);

        $employee->update($data);

        return redirect()->route('employees.index')->with('ok', 'Karyawan diperbarui.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('ok', 'Karyawan dihapus.');
    }
}
