<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Tasks retrieved successfully',
            'data' => Task::all()
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $task = Task::create([
            'title' => $request->title,
            'completed' => $request->completed ?? false
        ]);

        return response()->json([
            'message' => 'Task created successfully',
            'data' => $task
        ], 201);
    }

    public function show(Task $task)
    {
        return response()->json([
            'message' => 'Task retrieved successfully',
            'data' => $task
        ], 200);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'sometimes|required',
            'completed' => 'sometimes|required|boolean'
        ]);

        $task->update($request->only(['title', 'completed']));

        return response()->json([
            'message' => 'Task updated successfully',
            'data' => $task
        ], 200);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ], 200);
    }
}