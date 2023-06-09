<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([

                'name' => 'required',
                'is_available' => 'required|boolean',
            ]);

            $employee = Employee::create($validated);

            return response()->json($employee, 201);
        } catch (\Illuminate\Validation\ValidationException $exception) {

            return response()->json(['errors' => $exception->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return $employee;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        try {

            $validated = $request->validate([

                'name' => 'required',
                'is_available' => 'required|boolean',
            ]);

            $employee->update($validated);

            return response()->json($employee, 200);
        } catch (\Illuminate\Validation\ValidationException $exception) {

            return response()->json(['errors' => $exception->errors()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(null, 204);
    }
}
