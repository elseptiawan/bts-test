<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['todo_list_id', 'name', 'is_completed'];

    public function todoList()
    {
        return $this->belongsTo(TodoList::class);
    }
}
