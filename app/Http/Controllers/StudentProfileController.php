<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class StudentProfileController extends Controller
{
    public function Index()
    {
        $studentprofiles = StudentProfile::all();
        return Inertia::render('StudentProfile/Index', compact('studentprofiles'));
    }

    public function studentprofileCreate()
    {
        return Inertia::render('StudentProfile/Create');
    }


public function StudentProfileStore(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'mobile' => 'required|string',
        'email' => 'required|string',
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
        $image->move('uploads/studentprofile_images', $imageName);
    }


    StudentProfile::create([
        'name' => $request->name,
        'mobile' => $request->mobile,
        'email' => $request->email,
        'description' => $request->description,
        'image' => $imageName ? 'uploads/studentprofile_images/' . $imageName : null,
    ]);

    return Redirect::route('studentprofiles')->with('message', 'StudentProfile Created');
}

public function studentprofileEdit(StudentProfile $studentprofile) {
    return Inertia::render('StudentProfile/Edit', compact('studentprofile'));
}
public function studentprofileUpdate(StudentProfile $studentprofile, Request $request) {
    // Validate the input data
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'mobile' => 'required|string',
        'email' => 'required|string',
        'description' => 'required|string',
        'image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
    ]);
    if ($validator->fails()) {
        return Redirect::back()->withErrors($validator)->withInput();
    }
    $data = [
        'name' => $request->name,
        'mobile' => $request->mobile,
        'email' => $request->email,
        'description' => $request->description,
    ];

    if ($request->hasFile('image')) {
        if ($studentprofile->image && file_exists(public_path($studentprofile->image))) {
            unlink(public_path($studentprofile->image)); 
        }
        $image = $request->file('image');
        $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/studentprofile_images'), $uniqueName); // Save the image
        $data['image'] = 'uploads/studentprofile_images/' . $uniqueName;
    }
    $studentprofile->update($data);
    return Redirect::route('studentprofiles')->with('message', 'StudentProfile Updated');
}

    public function studentprofileDelete(StudentProfile $studentprofile){

        $image = $studentprofile->image;
            if (File::exists(public_path($image))) {
                File::delete(public_path($image));
            }
            $studentprofile->delete();
        return Redirect::route('studentprofiles')->with('message', 'StudentProfile deleted');
    }
}