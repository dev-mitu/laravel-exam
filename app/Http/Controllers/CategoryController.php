<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function Index()
    {
        $categories = Category::all();
        return Inertia::render('Category/Index', compact('categories'));
    }

    public function CategoryCreate()
    {
        return Inertia::render('Category/Create');
    }


public function CategoryStore(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    if ($validator->fails()) {
        return Redirect::back()->withErrors($validator)->withInput();
    }

    $imageName = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->move('uploads/category_images', $imageName);
    }


    Category::create([
        'name' => $request->name,
        'image' => $imageName ? 'uploads/category_images/' . $imageName : null,
    ]);

    return Redirect::route('category')->with('message', 'Category Created');
}

public function categoryEdit(Category $category) {
    return Inertia::render('Category/Edit', compact('category'));
}
public function categoryUpdate(Category $category, Request $request) {
    $data = [
        'name' => $request->name,
    ];

    if ($request->hasFile('image')) {
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image)); 
        }
        $image = $request->file('image');
        $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/category_images'), $uniqueName); // Save the image
        $data['image'] = 'uploads/category_images/' . $uniqueName;
    }
    $category->update($data);
    return Redirect::route('category')->with('message', 'category Updated');
}

    public function categoryDelete(Category $category){

        $image = $category->image;
            if (File::exists(public_path($image))) {
                File::delete(public_path($image));
            }
            $category->delete();
        return Redirect::route('category')->with('message', 'Category deleted');
    }
}
