<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('company')->orderByDesc('created_at')->paginate(10);

        return Inertia::render('Employees/Index', [
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::select(['id', 'name', 'logo'])->orderByDesc('created_at')->get();

        return Inertia::render('Employees/Create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();

        $employee = Employee::create($validated);

        // return redirect()->route('employees.show', $employee->id)->with('success', "Employee '{$employee->first_name}' '{$employee->last_name}' created successfully!");
        return redirect()->route('employees.index', $employee->id)->with('success', "Employee '{$employee->first_name} {$employee->last_name}' created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with('success', "Employee '{$employee->first_name} {$employee->last_name}' was deleted successfully.");
    }
}
