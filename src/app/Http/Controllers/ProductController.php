<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('show', compact('product'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where('name', 'like', "%{$keyword}%")->paginate(10);
        return view('index', compact('products', 'keyword'));
    }

    public function edit($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();

        return view('edit', compact('product', 'seasons'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string',
            'seasons' => 'array',
            'image' => 'nullable|image|max:2048',
        ]);

        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];

        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists(str_replace('storage/', '', $product->image))) {
                Storage::delete(str_replace('storage/', '', $product->image));
            }

            $path = $request->file('image')->store('products', 'public');
            $product->image = 'storage/' . $path;
        }

        $product->save();

        $product->seasons()->sync($validated['seasons'] ?? []);

        return redirect('/products')->with('success', '商品情報を更新しました');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::exists(str_replace('storage/', '', $product->image))) {
            Storage::delete(str_replace('storage/', '', $product->image));
        }

        $product->seasons()->detach();
        $product->delete();

        return redirect('/products')->with('success', '商品を削除しました');
    }
    public function create()
    {
        $seasons = Season::all();
        return view('create', compact('seasons'));
    }
    
    public function store(\App\Http\Requests\ProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            return redirect()->back()->withErrors(['image' => '商品画像を登録してください'])->withInput();
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        if ($request->has('seasons')) {
            $product->seasons()->attach($request->seasons);
        }

        return redirect('/products')->with('success', '商品が登録されました');
    }

    public function index(Request $request)
    {
    $query = Product::query();

    $sort = $request->input('sort', 'asc');

    if ($sort == 'desc') {
        $products = $query->orderBy('price', 'desc')->paginate(6);
    } else {
        $products = $query->orderBy('price', 'asc')->paginate(6);
    }
    return view('index', compact('products', 'sort'));
    }
}
