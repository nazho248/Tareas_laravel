<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Cassandra\Exception\ValidationException;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){

        $todo = Todo::all();
        return view('index')->with('todos', $todo);
    }

    public function create(){
        return view('create');
    }


    public function details(Todo $todo){

        return view('details')->with('todos', $todo);

    }

    public function edit($todo){
        $todos = Todo::find($todo);
        return view('edit', compact('todos'));
    }

    public function complete (Todo $todo){

        //si ya estaba completada, la descompleta
        if ($todo->completed == true){
            $todo->completed = false;
        } else {
            $todo->completed = true;
        }
        $todo->save();

        session()->flash('success', 'La tarea ' . $todo->name . ' ha sido completada exitosamente.');

        return redirect('/');

    }

    public function update(Todo $todo){

        try {
            $this->validate(request(), [
                'name' => ['required'],
                'description' => ['required'],

            ]);
        } catch (ValidationException $e) {
        }

        $data = request()->all();


        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->save();

        session()->flash('success', 'La tarea ' . $todo->name . ' ha sido actualizada exitosamente.');

        return redirect('/');

    }

    public function delete(Todo $todo){

        $todo->delete();

        return redirect('/');

    }

    public function store(){

        //console log name and description

        try {
            $this->validate(request(), [
                'name' => ['required'],
                'description' => ['required']
            ]);
        } catch (ValidationException $e) {
        }


        $data = request()->all();


        $todo = new Todo();
        //On the left is the field name in DB and on the right is field name in Form/view
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->save();

        session()->flash('success', 'La tarea ha sido creada exitosamente.');

        ///console.log something in console
        return redirect('index');

    }



}
