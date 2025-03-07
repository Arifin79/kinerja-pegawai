<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use Carbon\Carbon;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        $information = !empty($keyword)
            ? Information::where('title', 'LIKE', "%$keyword%")
            ->orWhere('description', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage)
            : Information::latest()->paginate($perPage);

        return view('information.index', compact('information'));
    }

    public function create()
    {
        return view('information.create');
    }

    public function store(Request $request)
    {

        $product = new Information;

        $product->id = $request->id;
        $product->title = $request->title;
        $product->date = $request->date;
        $product->description = $request->description;

        $product->save();
        return redirect()->route('information.index')->with('success', 'Assignment Added successfully');
    }

    public function edit($id)
    {
        $information = Information::findOrFail($id);
        return view('information.edit', ['information' => $information]);
    }

    public function update(Request $request, Information $information)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $product = Information::find($request->hidden_id);

        $product->title = $request->title;
        $product->date = $request->date;
        $product->description = $request->description;

        $product->save();

        return redirect()->route('information.index')->with('success', 'Product Has Been Updated Successfully');
    }


    public function destroy($id)
    {
        $information = Information::findOrFail($id);
        $information->delete();
        return redirect('information')->with('success', 'product Deleted!');
    }
}
