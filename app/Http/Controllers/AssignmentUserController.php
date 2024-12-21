<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\Task;

class AssignmentUserController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        $taskQuery = Task::query();

        if (!empty($keyword)) {
            $taskQuery->where('title', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%");
        }

        $task = $taskQuery->latest()->paginate($perPage);

        return view('task.index', compact('task'));
    }

    public function taskIndex(Request $request, $id)
    {
        $keyword = $request->get('search');
        $perPage = config('pagination.per_page', 5);

        if (!empty($keyword)) {
            $taskQuery = Task::query();
            $taskQuery->where('project_name', 'LIKE', "%$keyword%")
                ->orWhere('customer_name', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%");
        }
        $task = $taskQuery->latest()->paginate($perPage);

        return view('tasks.taskIndex', compact('task', 'id'));
    }

    public function store(Request $request)
    {

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
        $product->employee_name = $request->employee_name;
        $product->deadline = $request->deadline;
        $product->image = $file_name;

        $product->save();
        return redirect()->route('assignment-user.index')->with('success', 'Assignment Added successfully');
    }

    public function create()
    {
        return view('assignment-user/create');
    }

    public function taskStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|mimes:png,jpg,jpeg,gif,svg|max:2028',
        ]);

        $file_name = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(storage_path('app/public/images'), $file_name);

        $task = new Task();
        $task->name = $request->name;
        $task->image = $file_name;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task berhasil disimpan!');
    }

    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        $task = Task::where('id', $id)->orderBy('created_at')->get();
        return view('assignment-user/edit', ['assignment' => $assignment, 'task' => $task]);
    }

    public function update(Request $request, Assignment $assignment)
    {
        $this->validateRequest($request);

        $file_name = $this->handleFileUpload($request);

        $this->updateAssignment($request, $assignment, $file_name);

        return redirect()->route('assignment-user.index')
            ->with('success', 'Product Has Been Updated Successfully');
    }

    private function validateRequest($request)
    {
        $request->validate([
            'project_name' => 'required',
        ]);
    }

    private function handleFileUpload($request)
    {
        if ($request->image != "") {
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $file_name);
            return $file_name;
        }
        return $request->hidden_product_image;
    }

    private function updateAssignment($request, $assignment, $file_name)
    {
        $assignmentModel = Assignment::find($request->hidden_id);

        $assignmentModel->project_name = $request->project_name;
        $assignmentModel->project_type = $request->project_type;
        $assignmentModel->customer_name = $request->customer_name;
        $assignmentModel->customer_type = $request->customer_type;
        $assignmentModel->deadline = $request->deadline;
        $assignmentModel->image = $file_name;

        $assignmentModel->save();

        return redirect()->route('assignment-user.index')->with('success', 'Product Has Been Updated Successfully');
    }


    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        $image_path = public_path() . "/images/";
        $image = $image_path . DIRECTORY_SEPARATOR . $assignment->image;
        if (file_exists($image)) {
            @unlink($image);
        }
        $assignment->delete();
        return redirect('home.assignment-user')->with('success', 'product Deleted!');
    }

    public function destroyer($id)
    {
        $task = Task::findOrFail($id);
        $image_path = public_path() . "/images/";
        $image = $image_path . DIRECTORY_SEPARATOR . $task->image;
        if (file_exists($image)) {
            @unlink($image);
        }
        $task->delete();
        return redirect()->route('home.assignment-user/edit', ['id' => $task->id])->with('success', 'Task Deleted!');
    }

    public function showTask($id)
    {
        $task = Task::with('employee')->findOrFail($id);
        return view('assignment-user.details', compact('task'));
    }
}
