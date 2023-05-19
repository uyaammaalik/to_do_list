@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-7">
            <h1 class="mt-4 mb-4">Add Task</h1>

            <form method="POST" action="/taskStore">
                @csrf
                <input type="hidden" name="list_id" value="{{$id = request()->route('id');}}" >
                <div class="form-group">
                    <label for="task-name">Task Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="task-name" >
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div><br>

                <div class="form-group">
                    <label for="due-date">Due Date</label>
                    <input type="date" name="dueDate" class="form-control @error('dueDate') is-invalid @enderror" id="due-date" >
                        @error('dueDate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div><br>

                <div class="form-group">
                    <label for="due-time">Due Time</label>
                    <input type="time" name="dueTime" class="form-control @error('dueTime') is-invalid @enderror" id="due-time" >
                        @error('dueTime')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div><br>

                <div class="form-group">
                    <label for="planning-date">Planning to do:</label>
                    <input type="date" name="planDate" class="form-control" id="due-time" >
                </div><br>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add Task</button>
                    <a href="/home" class="btn btn-outline-secondary">Cancel</a>
                </div>
                
            </form>
        </div>

        <div class="col-3">

            
            <h3 class="mt-4 mb-4 ms-5">Navigation</h1>

            <a href="/home" class="link-secondary ms-5" style="text-decoration: none">Home</a><br>
            <a href="/listadd" class="link-secondary ms-5" style="text-decoration: none">Add List</a>
        

            
        </div>
    </div>
    
</div>
@endsection