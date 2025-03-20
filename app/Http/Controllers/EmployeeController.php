<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('position', 'like', '%' . $request->search . '%');
        }

        $employees = $query->paginate(10); // Show 10 employees per page
        $employees = Employee::all();
        return view('Admin.employee', compact('employees'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('Admin.add_employee');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'office' => 'required|string|max:255',
            'age' => 'required|integer',
            'start_date' => 'required|date',
            'salary' => 'required|numeric',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.employee')->with('success', 'Employee added successfully.');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);  // Find employee by ID

        return view('Admin.edit_employee', compact('employee'));  // Pass employee to the view
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'office' => 'required|string|max:255',
            'age' => 'required|integer',
            'start_date' => 'required|date',
            'salary' => 'required|numeric',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($validated);

        return redirect()->route('employees.employee')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        // Find the employee by ID
        $employee = Employee::findOrFail($id);

        // Delete the employee
        $employee->delete();

        // Redirect back to the employee list with a success message
        return redirect()->route('employees.employee')->with('success', 'Employee deleted successfully.');
    }
}
