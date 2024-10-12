<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    // Get all items for a specific todo list
    public function index($todoListId)
    {
        $items = Item::where('todo_list_id', $todoListId)->get();

        return response()->json([
            'key' => 'items',
            'success' => true,
            'message' => 'Items retrieved successfully',
            'data' => $items
        ]);
    }

    // Create a new item
    public function store(Request $request, $todoListId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $item = Item::create([
            'todo_list_id' => $todoListId,
            'name' => $request->name,
        ]);

        return response()->json([
            'key' => 'item',
            'success' => true,
            'message' => 'Item created successfully',
            'data' => $item
        ], 201);
    }

    // Get a single item
    public function show($todoListId, $id)
    {
        $item = Item::where('id', $id)->where('todo_list_id', $todoListId)->firstOrFail();

        return response()->json([
            'key' => 'item',
            'success' => true,
            'message' => 'Item retrieved successfully',
            'data' => $item
        ]);
    }

    // Update an existing item
    public function update(Request $request, $todoListId, $id)
    {
        $item = Item::where('id', $id)->where('todo_list_id', $todoListId)->firstOrFail();

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'is_completed' => 'sometimes|boolean',
        ]);

        $item->update($request->only('name', 'is_completed'));

        return response()->json([
            'key' => 'item',
            'success' => true,
            'message' => 'Item updated successfully',
            'data' => $item
        ]);
    }

    // Delete an item
    public function destroy($todoListId, $id)
    {
        $item = Item::where('id', $id)->where('todo_list_id', $todoListId)->firstOrFail();
        $item->delete();

        return response()->json([
            'key' => 'item',
            'success' => true,
            'message' => 'Item deleted successfully',
            'data' => null
        ]);
    }

    public function updateStatus(Request $request, $todoListId, $id)
    {
        $item = Item::where('id', $id)->where('todo_list_id', $todoListId)->firstOrFail();

        $item->is_completed = true;
        $item->save();

        return response()->json([
            'key' => 'item',
            'success' => true,
            'message' => 'Item has been completed',
            'data' => $item
        ]);
    }
}
