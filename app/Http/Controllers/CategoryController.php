<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryModel::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'rental_price' => ['required'],
        ]);

        return CategoryModel::create($data);
    }

    public function show(CategoryModel $category)
    {
        return $category;
    }

    public function update(Request $request, CategoryModel $category)
    {
        $data = $request->validate([
            'name' => ['required'],
            'rental_price' => ['required'],
        ]);

        $category->update($data);

        return $category;
    }

    public function destroy(CategoryModel $category)
    {
        $category->delete();

        return response()->json();
    }
}
