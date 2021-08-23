<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $data = Product::latest()->get()->toArray();
            return response()->json(['success' => true, 'message' => 'Products found successfully.', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:2',
                'detail' => 'required|min:3'
            ]);

            $product = new Product([
                'name' => $request->input('name'),
                'detail' => $request->input('detail')
            ]);
            $product->save();

            return response()->json(['success' => true, 'message' => 'Product created successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $data = Product::find($id);
            return response()->json(['success' => true, 'message' => 'Product found successfully.', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:2',
                'detail' => 'required|min:3'
            ]);

            $product = Product::find($id);
            $product->update($request->all());

            return response()->json(['success' => true, 'message' => 'Product updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();

            return response()->json(['success' => true, 'message' => 'Product deleted successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }
}
