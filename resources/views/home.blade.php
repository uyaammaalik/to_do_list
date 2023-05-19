@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ToDo List') }}
                    <a href="/listadd"><span class="btn btn-outline-primary btn-sm float-end">Add List</span></a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Check list empty or not --}}
                    @if(isset($list) && $list->isEmpty())
                        There is no Lists
                        @else
                        <ul class="list-group">
                        
                        @foreach ($list as $l)

                        <li class="list-group-item list-group-item-action">
                            <a aria-current="true">
                                {{ $l->name }} 

                                {{-- Buttons for edit and delete list and adding task --}}
                                <div class="float-end">
                                    <a href="/addtask/{{ $l->id }}"><span class="btn btn-outline-primary btn-sm">Add Task</span></a>
                                    <a href="/editList/{{ $l->id }}" ><button class="btn btn-outline-primary btn-sm" >Edit</button></a>
                                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDeleteList({{ $l->id }})">Delete</button>
                                </div>
                                                            
                                <br><br>

                                @if(isset($task) && $task->isEmpty())

                                    <ul class="list-group">
                        
                                        <li class=" list-group-item"> There is no Tasks</li>
                                    </ul>

                                @else

                                <ul class="list-group">

                                    <li class="list-group-item active">
                                            
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fas fa-list-check fa-lg mt-2" title="Completion"></i>
                                            </div>
                                            <div class="col-3">
                                                Name
                                            </div>
                                            <div class="col-2">
                                                Due Date
                                            </div>
                                            <div class="col-2">
                                                Due Time
                                            </div>
                                            <div class="col-2">
                                                Completion
                                            </div>

                                            {{-- Buttons for edit and delete tasks --}}
                                            <div class="col-2">
                                                Action
                                            </div>
                                        </div>
                                    </li>

                                    {{-- list out all the tasks belogsto particular list --}}
                                    @foreach ($task->where('to_do_list_id', $l->id)->sortBy('due_date') as $t)
                                    
                                        {{-- highlight the task which is overdue --}}
                                        <li class="{{ $t->due_date < $today && $t->is_complete == 0 ? 'list-group-item-danger' : '' }} list-group-item" title="{{ $t->due_date < $today && $t->is_complete == 0 ? 'Due date passed' : '' }}">
                                            
                                            <div class="row">
                                                <div class="col-1">

                                                    {{-- form for completion of task --}}
                                                    <form action="/task/{{ $t->id }}/complete" method="POST">
                                                        @csrf
                                                        <input type="checkbox" id="completed" class="mt-2" title="Click to complete" name="completed" value="1" onchange="this.form.submit()" {{ $t->is_complete ? 'checked' : '' }} >
                                                    </form>

                                                </div>
                                                <div class="col-3">
                                                    {{-- list all task name --}}
                                                    {{ $t->name }}
                                                </div>
                                                <div class="col-2">
                                                    {{-- list task's due date --}}
                                                    {{ $t->due_date }}
                                                </div>
                                                <div class="col-2">
                                                    {{-- list task's due time --}}
                                                    {{ $t->due_time }}
                                                </div>
                                                <div class="col-2">
                                                    {{-- Check whether task completed or not --}}
                                                    @if($t->is_complete == 0)
                                                        Not Completed
                                                    @else
                                                        Completed
                                                    @endif
                                                </div>

                                                {{-- Buttons for edit and delete tasks --}}
                                                <div class="col-2">
                                                    <a href="/addPlan/{{ $t->id }}" ><i class="fas fa-plus fa-lg" title="Add to Plan"></i></a>&nbsp;&nbsp;
                                                    <a href="/editTask/{{ $t->id }}" ><i class="fas fa-edit fa-lg" title="Edit"></i></a>&nbsp;&nbsp;
                                                    {{-- <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $t->id }})">Delete</button> --}}
                                                    <a href="#"><i onclick="confirmDelete({{ $t->id }})" class="fas fa-trash fa-lg" title="Delete"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                                @endif

                            </a>
                        </li>
                        @endforeach
                        
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-4">

            <div class="card">
                <div class="card-header">
                        Today's Plan
                </div>
                <div class="card-body">
                    @if(@isset($dailytasks) && $dailytasks->isEmpty())
                        There is no Tasks Today
                    @else
                    <ul class="list-group">

                        {{-- Heading of the list --}}
                        <li class="list-group-item list-group-item-action active">
                            
                            <div class="row">
                                <div class="col-1">
                                    <i class="fas fa-list-check fa-lg mt-2" title="Completion"></i>
                                </div>
                                <div class="col-5">
                                    Name
                                </div>
                        
                                <div class="col-4">
                                    Due Date
                                </div>
                                
                                <div class="col-1">
                                    <i class="fas fa-file-pen fa-lg mt-2" title="Action"></i>
                                    
                                </div>
                            </div>
                        </li>

                    {{-- list all the task panning to do today --}}
                    @foreach (($dailytasks)->sortBy('due_time') as $dt)
                                
                        <li class="list-group-item list-group-item-action">
                            
                            <div class="row">
                                <div class="col-1">

                                    {{-- form for completion of task --}}
                                    <form action="/task/{{ $dt->id }}/complete" method="POST">
                                        @csrf
                                        <input type="checkbox" id="completed" class="mt-2" name="completed" value="1" title="Click to Complete" onchange="this.form.submit()" {{ $dt->is_complete ? 'checked' : '' }} >
                                    </form>

                                </div>
                                <div class="col-5">
                                    {{ $dt->name }}
                                </div>
                        
                                <div class="col-4">
                                    {{ $dt->due_date }}
                                </div>
                                
                                <div class="col-1">
                                    <a href="/addPlan/{{ $dt->id }}" ><i class="fas fa-edit fa-lg mt-2" title="Reschedule"></i></a>
                                    
                                </div>
                            </div>
                        </li>
                    
                    @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-header">
                        Tomorrow's Plan
                </div>
                <div class="card-body">
                    @if(@isset($tomorrow) && $tomorrow->isEmpty())
                        There is no Tasks Tomorrow
                    @else
                    <ul class="list-group">
                        {{-- Heading of the list --}}
                        <li class="list-group-item list-group-item-action active">
                            
                            <div class="row">
                                <div class="col-1">
                                    <i class="fas fa-list-check fa-lg mt-2" title="Completion"></i>
                                </div>
                                <div class="col-5">
                                    Name
                                </div>
                        
                                <div class="col-4">
                                    Due Date
                                </div>
                                
                                <div class="col-1">
                                    <i class="fas fa-file-pen fa-lg mt-2" title="Action"></i>
                                    
                                </div>
                            </div>
                        </li>

                        {{-- list all the task planning to do tomorrow --}}
                    @foreach (($tomorrow)->sortBy('due_time') as $tm)
                                    
                        <li class="list-group-item list-group-item-action">
                            
                            <div class="row">
                                <div class="col-1">

                                    {{-- form for completion of task --}}
                                    <form action="/task/{{ $tm->id }}/complete" method="POST">
                                        @csrf
                                        <input type="checkbox" id="completed" class="mt-2" name="completed" value="1" title="Click to Complete" onchange="this.form.submit()" {{ $tm->is_complete ? 'checked' : '' }} >
                                    </form>

                                </div>
                                <div class="col-5">
                                    {{ $tm->name }}
                                </div>
                        
                                <div class="col-4">
                                    {{ $tm->due_time }}
                                </div>
                                
                                <div class="col-1">
                                    <a href="/addPlan/{{ $tm->id }}" ><i class="fas fa-edit fa-lg mt-2" title="Reschedule"></i></a>
                                    
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script>

    // Delete particular task
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this item?')) {

            window.location.href = '/deleteTask/' + id;
        }
    }

    // Delete particular list and whatever tasks belongs to the list
    function confirmDeleteList(id) {
        if (confirm('Are you sure you want to delete this item?')) {
            // Redirect to the delete route or perform the deletion
            window.location.href = '/deleteList/' + id;
        }
    }
</script>