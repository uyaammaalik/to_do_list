@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-7">
            <h1 class="mt-4 mb-4">Update Todo List</h1>

            <form method="POST" action="/listUpdate">
                @csrf
                <input type="hidden" class="form-control" name="id" value="{{ $list->id }}" id="list-name" >
                <div class="form-group">
                    <label for="list-name">List Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $list->name }}" name="name" id="list-name" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div><br>
        
                <div class="form-group">
                    <label for="list-description">List Description</label>
                    <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="list-description" rows="3">{{ $list->description }}</textarea>
                    @error('desc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div><br>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update List</button>
                    <a href="home"> <button type="" class="btn btn-outline-secondary">Cancel</button></a>
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