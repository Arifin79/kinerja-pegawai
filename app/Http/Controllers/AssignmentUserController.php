<?php

namespace App\Http\Controllers;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\Task;

class AssignmentUserController extends Controller
{
    //
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
        $assignment = Assignment::orderby('created_at')->get();
        $keyword = $request->get('search');
        $perPage = 5;

        if(!empty($keyword)){
            $assignment = Assignment::where('project_name', 'LIKE', "%$keyword%")
                        ->orWhere('customer_name', 'LIKE', "%$keyword%")
                        ->latest()->paginate($perPage);
        } else {
            $assignment = Assignment::latest()->paginate($perPage);
        }

        return view ('assignment-user.index', ['assignment' => $assignment, 'task' => $task])->with('i', (request()->input('page', 1)-1) *5);
    }

    public function taskIndex(Request $request, $id)
    {
        $assignment = Assignment::find($id);
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

        $assignment = Assignment::orderby('created_at')->get();
        $keyword = $request->get('search');
        $perPage = 5;

        if(!empty($keyword)){
            $assignment = Assignment::where('project_name', 'LIKE', "%$keyword%")
                        ->orWhere('customer_name', 'LIKE', "%$keyword%")
                        ->latest()->paginate($perPage);
        } else {
            $assignment = Assignment::latest()->paginate($perPage);
        }
        return view ('assignment-user/edit', ['assignment' => $assignment, 'task' => $task])->with('i', (request()->input('page', 1)-1) *5);
    }

    public function store(Request $request){

        $product = new Assignment;

        $request->validate([
            'project_name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,gif,svg|max:2028'
        ]);

        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);

        $product->id = $request->id;
        $product->project_name = $request->project_name;
        $product->project_type = $request->project_type;
        $product->customer_name = $request->customer_name;
        $product->customer_type = $request->customer_type;
        $product->deadline = $request->deadline;
        $product->image = $file_name;

        $product->save();
        return redirect()->route('assignment-user.index')->with('success', 'Assignment Added successfully');

    }

    public function create()
    {
        return view('assignment-user/create');
    }

    public function taskStore(Request $request){

        $product = new Task;
        $producti = new Assignment;

        // $request->validate([
        //     'name' => 'required',
        //     'image' => 'required|mimes:png,jpg,jpeg,gif,svg|max:2028'
        // ]);

        $file_name = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $file_name);

        $producti->id = $request->id;
        $product->id = $request->id;
        $product->name = $request->name;
        $product->title = $request->title;
        $product->date = $request->date;
        $product->image = $file_name;

        $product->save();

        return redirect()->route('home.assignment-user/edit', ['id' => $product->id])->with('success', 'Assignment Added successfully');
    }

    public function edit($id){
        $assignment = Assignment::findOrFail($id);
        $task = Task::where('id', $id)->orderBy('created_at')->get();
        dd($task);
        return view('assignment-user/edit', ['assignment' => $assignment, 'task' => $task]);
    }

    public function update(Request $request, Assignment $assignment){
        $request->validate([
            'project_name' => 'required'
        ]);

        $file_name = $request->hidden_product_image;

        if($request->image != ""){
            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $file_name);
        }

        $assignment = Assignment::find($request->hidden_id);

        $assignment->project_name = $request->project_name;
        $assignment->project_type = $request->project_type;
        $assignment->customer_name = $request->customer_name;
        $assignment->customer_type = $request->customer_type;
        $assignment->deadline = $request->deadline;
        $assignment->image = $file_name;

        $assignment->save();

        return redirect()->route('assignment-user.index')->with('success', 'Product Has Been Updated Successfully');

    }

    public function destroy($id){
        $assignment = Assignment::findOrFail($id);
        $image_path = public_path(). "/images/";
        $image = $image_path. $assignment->image;
        if(file_exists($image)){
            @unlink($image);
        }
        $assignment->delete();
        return redirect('home.assignment-user')->with('success', 'product Deleted!');
    }

    public function destroyer($id){
        $task = Task::findOrFail($id);
        $image_path = public_path(). "/images/";
        $image = $image_path. $task->image;
        if(file_exists($image)){
            @unlink($image);
        }
        $task->delete();
        return redirect()->route('home.assignment-user/edit', ['id' => $task->id])->with('success', 'Task Deleted!');
    }

}
