<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use Carbon\Carbon;

class InformationUserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        $informationQuery = Information::query();

        if (!empty($keyword)) {
            $informationQuery->where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%");
        }

        $information = $informationQuery->latest()->paginate($perPage);

        return view('information.index', compact('information'));
    }

    public function store(Request $request)
    {

        $product = new Information;

        $product->id = $request->id;
        $product->title = $request->title;
        $product->date = $request->date;
        $product->description = $request->description;

        $product->save();
        return redirect()->route('information-user.index')->with('success', 'Assignment Added successfully');
    }
}
