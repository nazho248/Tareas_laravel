@extends('templates.app')
@section('title')
    My Todo App
@endsection
@section('content')

    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a href="/"><span class="navbar-brand mb-0 h1">Lista de Tareas</span></a>
            <a href="/create"><span class="btn btn-primary">Crear Nueva Tarea</span></a>
        </div>
    </nav>

    <div class="row mt-3">
        <div class="col-12 align-self-center">
            <h2 class="text-center">Lista de Tareas por realizar</h2>
            <ul class="list-group">
                @foreach($todos->where('completed', false) as $todo)
                    <li class="list-group-item">
                        <a href="details/{{$todo->id}}" style="color: cornflowerblue">{{$todo->name}}</a>
                        {{--en el centro la descripcion--}}
                        <span class="float-center">{{$todo->description}}</span>
                        {{--botones para su manejo--}}
                        <a href="details/edit/{{$todo->id}}"><span class="btn btn-warning float-end ms-2">
                            <i class="bi bi-pencil-square"></i> </span></a>
                        <a href="/delete/{{$todo->id}}"><span class="btn btn-danger float-end ms-2"><i class="bi bi-trash"></i></span></a>
                        <a href="/complete/{{$todo->id}}"><span class="btn float-end btn-success ms-2">
                            <i class="bi bi-check-circle"></i></span></a>


                    </li>
                @endforeach

            </ul>

            <br>
            <h2 class="text-center">Lista de Tareas Completadas</h2>
            <ul class="list-group">
                @foreach($todos->where('completed', true) as $todo)
                    <li class="list-group-item">
                        <a href="details/{{$todo->id}}" style="color: cornflowerblue">{{$todo->name}}</a>
                        {{--en el centro la descripcion--}}
                        <span class="float-center">{{$todo->description}}</span>
                        {{--botones para su manejo--}}
                        <a href="details/edit/{{$todo->id}}"><span class="btn btn-warning float-end ms-2">
                            <i class="bi bi-pencil-square"></i> </span></a>
                        <a href="/delete/{{$todo->id}}"><span class="btn btn-danger float-end ms-2"><i class="bi bi-trash"></i></span></a>
                        <a href="/complete/{{$todo->id}}"><span class="btn float-end btn-success ms-2">
                            <i class="bi bi-x-circle-fill"></i></span></a>


                    </li>
                @endforeach

            </ul>

        </div>

    </div>

@endsection
