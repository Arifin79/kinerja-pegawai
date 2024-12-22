<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        $task = !empty($keyword)
            ? Task::where('title', 'LIKE', "%$keyword%")
            ->orWhere('name', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage)
            : Task::latest()->paginate($perPage);

        return view('tasks.index', ['tasks' => $task,]);
    }

    public function store(Request $request)
    {
        $product = new Task;

        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,gif,svg|max:2028',
            'title' => 'required',
            'date' => 'required|date',
        ]);

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
