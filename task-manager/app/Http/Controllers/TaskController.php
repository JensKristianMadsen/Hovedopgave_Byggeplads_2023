<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'description' => 'required',
                'tool_id' => 'required|exists:tools,id',
                'employee_id' => 'required|exists:employees,id',
                'is_completed' => 'required|boolean',

            ]);

            $task = Task::create($validated);

            return response()->json($task, 201);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return response()->json([
                'errors' => $exception->errors()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        try {
            $validated = $request->validate([
                'description' => 'sometimes|required',
                'tool_id' => 'sometimes|required|exists:tools,id',
                'employee_id' => 'sometimes|required|exists:employees,id',
                'is_completed' => 'sometimes|required|boolean',
            ]);

            $task->update($validated);

            return response()->json($task, 200);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return response()->json([
                'errors' => $exception->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
