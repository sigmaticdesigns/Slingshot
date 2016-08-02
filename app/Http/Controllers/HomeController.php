<?php

namespace App\Http\Controllers;

use App\Category;
use App\Project;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::active()->with('image')->latest()->take(6)->get();
		$categoryList = Category::orderBy('name')->get();

	    $slider = option('index.slider');
	    if ($slider) {
		    $slider = json_decode($slider);
	    }

        return view('home', compact('projects', 'categoryList', 'slider'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
