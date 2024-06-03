<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $task = Task::orderby('created_at')->get();
        $keyword = $request->get('search');
        $perPage = 5;

        if(!empty($keyword)){
            $task = Task::where('title', 'LIKE', "%$keyword%")
                        ->orWhere('name', 'LIKE', "%$keyword%")
                        ->latest()->paginate($perPage);
        } else {
            $task = Task::latest()->paginate($perPage);
        }

        return view ('task.index', ['task' => $task])->with('i', (request()->input('page', 1)-1) *5);
    }

    public function store(Request $request){

        $product = new Task;

        // $request->validate([
        //     'name' => 'required',
        //     'image' => 'required|mimes:png,jpg,jpeg,gif,svg|max:2028'
        // ]);

        $file_name = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $file_name);

        $product->name = $request->name;
        $product->title = $request->title;
        $product->date = $request->date;
        $product->image = $file_name;

        $product->save();

        return redirect()->route('assignment/edit')->with('success', 'Assignment Added successfully');
    }

}
