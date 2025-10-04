<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::query()
            ->when(
                $request->filled('search'),
                fn($q) =>
                $q->where('department_name', 'like', '%' . $request->search . '%')
            )
            ->orderBy('department_name')
            ->paginate(10)
            ->withQueryString();

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        $department = Department::all();
        return view('departments.create', compact('department'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name'    => 'required|string|max:255',
            'max_clock_in_time'  => 'required|date_format:H:i',
            'max_clock_out_time' => 'required|date_format:H:i',
        ]);

        
        $validator->after(function ($v) use ($request) {
            $in  = $request->input('max_clock_in_time');   
            $out = $request->input('max_clock_out_time');  
            if ($out < $in) {
                $v->errors()->add('max_clock_out_time', 'Waktu maksimal keluar tidak boleh lebih kecil dari waktu maksimal masuk.');
            }
        });

        $validator->validate();

        Department::create($validator->validated());

        return redirect()->route('departments.index')->with('ok', 'Department dibuat.');
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
        $validator = Validator::make($request->all(), [
            'department_name'    => 'required|string|max:255',
            'max_clock_in_time'  => 'required|date_format:H:i',
            'max_clock_out_time' => 'required|date_format:H:i',
        ]);

        $validator->after(function ($v) use ($request) {
            $in  = $request->input('max_clock_in_time');
            $out = $request->input('max_clock_out_time');

            if ($out < $in) {
                $v->errors()->add('max_clock_out_time', 'Waktu maksimal keluar tidak boleh lebih kecil dari waktu maksimal masuk.');
            }
        });

        $validator->validate();

        $department->update($validator->validated());

        return redirect()->route('departments.index')->with('ok', 'Department diperbarui.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('ok', 'Departemen dihapus.');
    }
}
