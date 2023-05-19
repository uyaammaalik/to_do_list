<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ToDoList;
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

        $list = ToDoList::where('user_id', $id)->get();

        //Calling all the task blongs to particular list
        $task = Task::whereIn('to_do_list_id', $list->pluck('id'))->get();

        $today = Carbon::now()->toDateString();

        $tomorrowdate = Carbon::now()->addDay()->toDateString();

        $dailytasks = Task::where('planningToDo', $today)->where('user_id', $id)->get();

        $tomorrow = Task::where('planningToDo', $tomorrowdate)->where('user_id', $id)->get();

        return view('home', compact('list', 'task', 'dailytasks', 'tomorrow', 'today'));
    }
}