<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('addTask');
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required|max:255',
            'dueDate' => 'required',
            'dueTime' => 'required',
        ]);

        $task = new Task();
        $id = Auth::id();

        $task->to_do_list_id = $req->list_id;
        $task->name = $req->name;
        $task->user_id = $id;
        $task->due_date = $req->dueDate;
        $task->due_time = $req->dueTime;
        $task->planningToDo = $req->planDate;

        $task->save();
        return redirect('home');
    }

    public function edit($id)
    {
        // Retrieve the task
        $task = Task::findOrFail($id);

        return view('editTask', compact('task'));
    }

    public function delete($id)
    {

        $task = Task::findOrFail($id);

        $task->delete();

        return redirect('/home');
    }

    public function update(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required|max:255',
            'dueDate' => 'required',
            'dueTime' => 'required',
        ]);

        $task = Task::findOrFail($req->id);

        $task->name = $req->name;
        $task->due_date = $req->dueDate;
        $task->due_time = $req->dueTime;
        $task->planningToDo = $req->planDate;

        $task->save();
        return redirect('home');
    }

    public function isComplete(Request $req, $id)
    {
        $task = Task::findOrFail($id);

        if ($req->completed == '1') {
            // Checkbox is checked
            $task->is_complete = true;
            // $message = 'Task marked as completed.';
        } else {
            // Checkbox is not checked
            $task->is_complete = false;
            //$message = 'Task marked as incomplete.';
        }

        $task->save();

        return redirect('home');

        //return redirect()->back()->with('success', $message);
    }

    public function addToPlan($id)
    {
        $modal = true;



        // Retrieve the task
        $addTask = Task::findOrFail($id);

        return view('addPlan', compact('task'));

        // Pass the variable to the view
        //return view('/home', compact('addTask', 'modal'));
    }

    public function updatePlan(Request $req)
    {

        $task = Task::findOrFail($req->id);

        $task->due_date = $req->dueDate;

        $task->planningToDo = $req->planDate;

        $task->save();
        return redirect('home');
    }
}