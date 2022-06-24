<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index(){
        $todo = Todo::all();
        return view('index')->with('todos', $todo);
    }

    public function details(Todo $todo){
        return view('details')->with('todos', $todo);
    }

    public function edit(Todo $todo){
        return view('edit')->with('todos', $todo);;
    }
    
    public function update(Request $request,Todo $todo){

        $request->validate([
            'name' => ['required'],
            'description' => ['required']
        ]);
        
        $todo->name = $request->input('name');
        $todo->description = $request->input('description');
        $todo->save();

        session()->flash('success', 'Todo updated successfully');

        return redirect('/');
    }
    
    public function delete(Todo $todo){
        $todo->delete();
        return redirect('/');
    }

    public function create(){
        return view('create');
    }
    public function store(Request $request){

        $request->validate([
            'name' => ['required'],
            'description' => ['required']
        ]);

        $todo = new Todo();
        //On the left is the field name in DB and on the right is field name in Form/view
        $todo->name = $request->input('name');
        $todo->description = $request->input('description');
        $todo->save();

        session()->flash('success', 'Todo created succesfully');

        return redirect('/');
    }

}
