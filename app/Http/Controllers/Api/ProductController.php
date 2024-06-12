<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Information;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = 5;
            $information = Information::latest()->paginate($perPage);

            return response()->json([
                "status" => 200,
                "message" => "Data Sukses Diterima",
                "data" => $information
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 500,
                "message" => "Error fetching data",
                "error" => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $product = new Information;

            $product->title = $request->title;
            $product->date = $request->date;
            $product->description = $request->description;

            $product->save();

            return response()->json([
                "status" => 200,
                "message" => "Data Sukses Submit",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 500,
                "message" => "Error submitting data",
                "error" => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Information::findOrFail($id);

            $product->title = $request->title;
            $product->date = $request->date;
            $product->description = $request->description;

            $product->save();

            return response()->json([
                "status" => 200,
                "message" => "Data Sukses Diupdate",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 500,
                "message" => "Error updating data",
                "error" => $th->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $product = Information::findOrFail($id);
            $product->delete();

            return response()->json([
                "status" => 200,
                "message" => "Data Sukses Dihapus",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 500,
                "message" => "Error deleting data",
                "error" => $th->getMessage()
            ], 500);
        }
    }
}
