<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;
use Illuminate\Support\Facades\Auth;

class TodoListController extends Controller
{
    // Get all todo lists for the authenticated user
    public function index()
    {
        $todoLists = TodoList::where('user_id', Auth::id())->get();

        return response()->json([
            'success' => true,
            'message' => 'Todo lists retrieved successfully',
            'data' => $todoLists
        ]);
    }

    // Create a new todo list
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todoList = TodoList::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Todo list created successfully',
            'data' => $todoList
        ], 201);
    }

    // Get a single todo list
    public function show($id)
    {
        $todoList = TodoList::with('items')->first();
        if ($todoList->user_id !== Auth::id()) {
            return response()->json([
                'key' => 'error',
                'success' => false,
                'message' => 'Unauthorized',
                'data' => null
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Todo list retrieved successfully',
            'data' => $todoList
        ]);
    }

    // Update an existing todo list
    public function update(Request $request, $id)
    {
        $todoList = TodoList::findOrFail($id);
        if ($todoList->user_id !== Auth::id()) {
            return response()->json([
                'key' => 'error',
                'success' => false,
                'message' => 'Unauthorized',
                'data' => null
            ], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todoList->update($request->only('title'));

        return response()->json([
            'success' => true,
            'message' => 'Todo list updated successfully',
            'data' => $todoList
        ]);
    }

    // Delete a todo list
    public function destroy($id)
    {
        $todoList = TodoList::findOrFail($id);
        if ($todoList->user_id !== Auth::id()) {
            return response()->json([
                'key' => 'error',
                'success' => false,
                'message' => 'Unauthorized',
                'data' => null
            ], 403);
        }

        $todoList->delete();

        return response()->json([
            'success' => true,
            'message' => 'Todo list deleted successfully',
            'data' => null
        ]);
    }
}
