<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ToDoList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::id();
        $today = Carbon::now()->toDateString();
        $tomorrow = Carbon::now()->addDay()->toDateString();

        $user = User::find($id);

        $list = $user->toDoLists()->get();
        $task = $user->tasks()->get();
        $dailytasks = $user->tasks()->where('planningToDo', $today)->get();
        $tomorrow = $user->tasks()->where('planningToDo', $tomorrow)->get();

        return view('home', compact('list', 'task', 'dailytasks', 'tomorrow', 'today'));
    }
}