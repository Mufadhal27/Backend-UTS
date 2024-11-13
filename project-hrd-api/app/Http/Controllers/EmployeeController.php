<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    
    public function index()
    {
        return Employee::all();
    }


    public function store (Request $request) {
        $input = [
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'email' => $request->email,
            'telepon' => $request->telepon,
        ];

        $employee = Employee::create($input);

        $data = [
            'message' => 'Employee is created succesfully',
            'data' => $employee,
        ];

        return response()->json($data, 201);
    }


    public function show($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $data = [
                'message' => 'Get detail employee',
                'data' => $employee,
            ];

            return response()->json($data,200);
        } else {
            $data = [
                'message' => 'Employee not found',
            ];

            return response()->json($data, 404);
        }
    }

    public function update(Request $request, $id) {
        $employee = Employee::find($id);
    
        if ($employee) {
            $input = [
                'nama' => $request->nama ?? $employee->nama,
                'posisi' => $request->posisi ?? $employee->posisi,
                'email' => $request->email ?? $employee->email,
                'telepon' => $request->telepon ?? $employee->telepon
            ];
    
            $employee->update($input);
    
            $data = [
                'message' => 'Employee is updated',
                'data' => $employee
            ];
    
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Employee not found'
            ];
    
            return response()->json($data, 404);
        }
    }
    

    public function destroy($id) {
        $employee = Employee::find($id);
    
        if ($employee) {
            $employee->delete();
    
            $data = [
                'message' => 'Employee is deleted'
            ];
    
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Employee not found'
            ];
    
            return response()->json($data, 404);
        }
    }
    
}

