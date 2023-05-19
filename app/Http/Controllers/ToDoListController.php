<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('/addToDoList');
    }
    public function store(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required|max:255',
            'desc' => 'required',
        ]);

        $list = new ToDoList();
        $id = Auth::id();

        $list->user_id = $id;
        $list->name = $req->name;
        $list->description = $req->desc;

        $list->save();
        return redirect('/home');
    }

    public function edit($id)
    {
        $list = ToDoList::findOrFail($id);

        return view('editList', compact('list'));
    }

    public function update(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required|max:255',
            'desc' => 'required',
        ]);

        $list = ToDoList::findOrFail($req->id);

        $list->name = $req->name;
        $list->description = $req->desc;

        $list->save();
        return redirect('/home');
    }

    public function delete($id)
    {
        // Retrieve the data
        $list = ToDoList::findOrFail($id);
        $tasks = Task::where('to_do_list_id', $id);

        // Perform the deletion
        $list->delete();
        $tasks->delete();

        return redirect('/home');
    }
}