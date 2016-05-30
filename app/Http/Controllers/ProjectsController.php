<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use App\Project;



class ProjectsController extends Controller
{

	public function __construct()
	{

	}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
	    $projects = Project::active()->latest()->paginate(20);

        $no = $projects->firstItem();

        return view('projects.index', compact('projects', 'no'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.show', compact('project'));
    }



}
