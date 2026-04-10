<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->todos();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != 'all') {
            $status = $request->status == 'completed' ? true : false;
            $query->where('is_completed', $status);
        }

        $sort = $request->get('sort', 'desc');
        $todos = $query->orderBy('created_at', $sort)->paginate(10);

        if ($request->ajax()) {
            return view('todos.partials.list', compact('todos'))->render();
        }

        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Auth::user()->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('todos.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function edit(Todo $todo)
    {
        $this->authorizeTodo($todo);
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $this->authorizeTodo($todo);
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('todos.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy(Todo $todo)
    {
        $this->authorizeTodo($todo);
        $todo->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('todos.index')->with('success', 'Tugas berhasil dihapus!');
    }

    public function toggle($id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        
        $todo->is_completed = !$todo->is_completed;
        $todo->save();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'completed' => (bool) $todo->is_completed
            ]);
        }

        return back();
    }

    private function authorizeTodo(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
