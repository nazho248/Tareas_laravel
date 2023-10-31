@extends('templates.app')
@section('title')
    Edit Todo
@endsection
@section('content')

    <form action="/update/{{$todos->id}}" method="post" class="mt-4 p-4">
        @csrf
        <div class="form-group m-3">
            <label for="name">Nombre de la tarea</label>
            <input type="text" class="form-control" value="{{$todos->name}}" name="name" placeholder="Enter Todo Name">

        </div>
        <div class="form-group m-3">
            <label for="description">Descripción</label>
            <textarea class="form-control" name="description" rows="3"> {{$todos->description}} </textarea>
        </div>
        <div class="form-group m-3">
            <input type="submit" class="btn btn-primary float-end" value="Guardar">
        </div>
    </form>

@endsection
