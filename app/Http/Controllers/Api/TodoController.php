<?php

namespace App\Http\Controllers\Api;

use App\Enums\TodoStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TodoController extends Controller
{
    public function index()
    {
        return TodoResource::collection(Auth::user()->todos()->latest('id')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $todo = Todo::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'status' => TodoStatus::TODO->value
        ]);

        return TodoResource::make($todo);
    }

    public function show(Todo $todo)
    {
        $todo = Todo::findOrFail($todo->id);

        return TodoResource::make($todo);
    }

    public function update(Request $request, Todo $todo)
    {
        Gate::authorize('update', $todo);

        $request->validate([
           'name' => 'required',
            'description' => 'required'
        ]);

        $todo->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Todo updated successfully',
            'data' => TodoResource::make($todo)
        ]);
    }

    public function destroy(Todo $todo)
    {
        Gate::authorize('update', $todo);

        $todo->delete();

        return response()->json([
            'message' => 'Todo deleted'
        ]);
    }
}
