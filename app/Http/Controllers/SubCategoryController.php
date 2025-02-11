<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function Index()
    {
       $subcategories = SubCategory::with('category')->get();
        return Inertia::render('SubCategory/Index',compact('subcategories'));
    }

    public function subCategoryCreate()
    {
        $categories = Category::all();
        return Inertia::render('SubCategory/Create', compact('categories'));
    }


public function subCategoryStore(Request $request)
{
    $validator = Validator::make($request->all(), [
        'category_id'=> 'required|string',
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
        $image->move('uploads/subcategory_images', $imageName);
    }


    SubCategory::create([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'image' => $imageName ? 'uploads/subcategory_images/' . $imageName : null,
    ]);

    return Redirect::route('subcategories')->with('message', 'Sub Category Created');
}

public function subCategoryEdit(SubCategory $subcategory) {
    $categories = Category::all();
    return Inertia::render('SubCategory/Edit', compact('subcategory','categories'));
}
public function subcategoryUpdate(SubCategory $subcategory, Request $request) {
    $data = [
        'category_id' => $request->category_id,
        'name' => $request->name,
    ];

    if ($request->hasFile('image')) {
        if ($subcategory->image && file_exists(public_path($subcategory->image))) {
            unlink(public_path($subcategory->image)); 
        }
        $image = $request->file('image');
        $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/subcategory_images'), $uniqueName); // Save the image
        $data['image'] = 'uploads/subcategory_images/' . $uniqueName;
    }
    $subcategory->update($data);
    return Redirect::route('subcategories')->with('message', 'subcategory Updated');
}

    public function subcategorytDelete(SubCategory $subcategory){

        $image = $subcategory->image;
            if (File::exists(public_path($image))) {
                File::delete(public_path($image));
            }
            $subcategory->delete();
        return Redirect::route('subcategories')->with('message', 'subcategory deleted');
    }
}
