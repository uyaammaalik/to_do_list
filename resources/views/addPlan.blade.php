@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-7">
            <h1 class="mt-4 mb-4">Add to Plan or Reschedule</h1>

            <form method="POST" action="/planUpdate">
                @csrf
                <input type="hidden" name="id" value="{{ $task->id }}">
                <input type="hidden" name="list_id" value="{{ $task->to_do_list_id }}">

                <div class="form-group">
                    <label for="due-date">Reschedule Due Date:</label>
                    <input type="date" name="dueDate" class="form-control @error('dueDate') is-invalid @enderror" value="{{$task->due_date}}" id="due-date" >
                        @error('dueDate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div><br>
                
                <div class="form-group">
                    <label for="plantime">Planning to do:</label>
                    <input type="date" name="planDate" class="form-control @error('planDate') is-invalid @enderror" value="{{$task->planningToDo}}" id="plantime" >
                        @error('planDate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div><br>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Plan</button>
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