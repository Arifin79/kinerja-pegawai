<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use Carbon\Carbon;

class InformationUserController extends Controller
{
    //
    public function index(Request $request)
    {
        $information = Information::orderby('created_at')->get();
        $keyword = $request->get('search');
        $perPage = 5;

        if(!empty($keyword)){
            $information = Information::where('title', 'LIKE', "%$keyword%")
                        ->orWhere('description', 'LIKE', "%$keyword%")
                        ->latest()->paginate($perPage);
        } else {
            $information = Information::latest()->paginate($perPage);
        }

        return view ('information-user.index', ['information' => $information])->with('i', (request()->input('page', 1)-1) *5);
    }

    public function store(Request $request){

        $product = new Information;

        $product->id = $request->id;
        $product->title = $request->title;
        $product->date = $request->date;
        $product->description = $request->description;

        $product->save();
        return redirect()->route('information-user.index')->with('success', 'Assignment Added successfully');

    }
}
