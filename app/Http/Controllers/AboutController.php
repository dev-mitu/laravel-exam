<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\About;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function Index()
    {
        $about = About::all();
        return Inertia::render('About/Index', compact('about'));
    }

    public function aboutCreate()
    {
        return Inertia::render('About/Create');
    }


public function AboutStore(Request $request)
{
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'mobile' => 'required|string',
        'description' => 'required|string|max:1000',
        'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    if ($validator->fails()) {
        return Redirect::back()->withErrors($validator)->withInput();
    }

    $imageName = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->move('uploads/about_images', $imageName);
    }


    About::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'mobile' => $request->mobile,
        'description' => $request->description,
        'image' => $imageName ? 'uploads/about_images/' . $imageName : null,
    ]);

    return Redirect::route('abouts')->with('message', 'About Created');
}

public function aboutEdit(About $about) {
    return Inertia::render('About/Edit', compact('about'));
}
public function aboutUpdate(About $about, Request $request) {
    // Validate the input data
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'mobile' => 'required|string',
        'description' => 'required|string',
        'image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
    ]);
    if ($validator->fails()) {
        return Redirect::back()->withErrors($validator)->withInput();
    }
    $data = [
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'mobile' => $request->mobile,
        'description' => $request->description,
    ];

    if ($request->hasFile('image')) {
        if ($about->image && file_exists(public_path($about->image))) {
            unlink(public_path($about->image)); 
        }
        $image = $request->file('image');
        $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/about_images'), $uniqueName); // Save the image
        $data['image'] = 'uploads/about_images/' . $uniqueName;
    }
    $about->update($data);
    return Redirect::route('abouts')->with('message', 'About Updated');
}

    public function aboutDelete(About $about){

        $image = $about->image;
            if (File::exists(public_path($image))) {
                File::delete(public_path($image));
            }
            $about->delete();
        return Redirect::route('abouts')->with('message', 'About deleted');
    }
}
