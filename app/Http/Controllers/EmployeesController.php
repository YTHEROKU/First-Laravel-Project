<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Employee;

class EmployeesController extends Controller
{
    public function create() {
        $data = [
            'scope' => 'create',
        ];
        return view('employee.form')->with($data);
    }

    public function storeEmployee(Request $request){
        try {
            $employee = new Employee;
            $employee->name = $request->get('name');
            $employee->department = $request->get('department');
            $employee->section = $request->get('section');
            $employee->email = $request->get('email');
            $employee->save();

            return response()->json([
                'status' => 200,
                'message' => 'Employee saved successfully',
            ]);
        }
        catch(Exception $e) {
            dd($e);
        }
    }

    public function index() {
        return view('employee.index');
    }

    public function getEmployeeData(Request $request) 
    {
        try {
            $query = Employee::select('name', 'department', 'section', 'email');

            if($request->searchQuery) {
                $query->where(function($q) use ($request) {
                    $q->orWhere('name', 'like', '%'.$request->searchQuery.'%');
                });
            };

            $employeeData = $query->get();

            return $employeeData;
        }catch(Exception $e) {
            dd($e);
        }

    }

    public function edit($id){
        $data = [
            'scope' => 'edit',
            'id' => $id
        ];

        return view('employee.form')->with($data);
    }

    public function getEmployeeDataById($id) {
        $employeeData = Employee::find($id);

        return response()->json([
            'status' => 200,
            'data' => $employeeData
        ]);
    }

    public function update(Request $request, $id) {
        try {

            $employee = Employee::find($id);
            $employee->name = $request->get('name');
            $employee->department = $request->get('department');
            $employee->section = $request->get('section');
            $employee->email = $request->get('email');
            $employee->update();
            
            return response()->json([
                'status' => 200,
                'message' => 'Employee updated successfully',
            ]);
        }
        catch(Exception $e) 
        {
            dd($e);
        }
    }

    public function show($id) {
        $data = [
            'scope' => 'show',
            'id' => $id
        ];

        return view('employee.form')->with($data);
    }

    public function destroy($id) {

        try {
            $employee = Employee::find($id);
            $employee->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Employee deleted successfully',
            ]);

        } catch(Exception $e){
            dd($e);
        }
        
    }

}
