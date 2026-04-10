<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoApiController extends Controller
{
    public function index()
    {
        // Simple API for currently authenticated user (using session for easy testing if called from browser)
        // In a real app, you'd use Sanctum/Passport.
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        return response()->json(Auth::user()->todos);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $todo = Auth::user()->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($todo, 201);
    }

    public function show(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json($todo);
    }

    public function update(Request $request, Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $request->validate([
            'title' => 'sometimes|required|max:255',
            'is_completed' => 'sometimes|boolean',
        ]);

        $todo->update($request->all());

        return response()->json($todo);
    }

    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $todo->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
