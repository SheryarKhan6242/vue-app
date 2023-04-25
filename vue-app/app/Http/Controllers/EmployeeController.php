<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->address = $request->address;
        $employee->mobile = $request->mobile;
        $employee->save();
        return response()->json("Employee Saved Successfully");
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update($request->all());
        return response()->json("Employee Updated Successfully");
    }

    public function destroy($id)
    {
        Employee::destroy($id);
        return response()->json("Employee Deleted Successfully");
    }
}
