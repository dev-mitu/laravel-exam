<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function Index(){
        $homes = Home::all();
        return Inertia::render('Home/Index', compact('homes'));
    }

    public function homeCreate(){
        return Inertia::render('Home/Create');
    }
   
    public function homeStore(Request $request){
        $validator = Validator::make($request->all(),[
            'gmail'=> 'required|string',
            'password'=> 'required|string',
        ]);
        if ($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Home::create([
            'gmail'=> $request->gmail,
            'password'=> $request->password,
        ]);
        return Redirect::route('home')->with('message', 'Home Created');
    }
    public function homeEdit(Home $home){
        return Inertia::render('Home/Edit', compact('home'));
    }
    public function homeUpdate(Home $home, Request $request) {
        $validator = Validator::make($request->all(), [
            'gmail' => 'required|string',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $home->update([
            'gmail' => $request->gmail,
            'password' => $request->password,
        ]);
    
        return Redirect::route('home')->with('message', 'Home Updated');
    }

    public function homeDelete(Home $home){
        
        $home->delete();
        return Redirect::route('home')->with('message', 'Home deleted');
    }
}
