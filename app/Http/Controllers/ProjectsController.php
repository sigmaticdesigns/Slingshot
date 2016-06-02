<?php

namespace App\Http\Controllers;


use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Input;


class ProjectsController extends Controller
{

	protected $perPage = 20;

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
	    $projects = Project::active()->latest()->paginate($this->perPage);

	    $showPagination = true;

	    $categoryList = Category::orderBy('name')->get();

        return view('projects.index', compact('projects', 'showPagination', 'categoryList'));
    }

	public function getList()
	{
		$projectsModel = Project::active();

		if (Input::has('category_id')) {
			$categoryId = intval(Input::get('category_id'));
			$projectsModel->where('category_id', $categoryId);
		}
		if (Input::has('sort'))
		{
			switch (Input::get('sort'))
			{
				case 'popular':
					$projectsModel->orderBy('created_at', 'desc');
					break;
				case 'trending':
					$projectsModel->orderBy('purse', 'desc');
					break;
				case 'ending':
					$projectsModel->orderBy('deadline');
					break;
				case 'recommended':
					$projectsModel->orderByRaw("RAND()");
					break;
			}
		}
		if ('projects' == Input::get('ref')) {
			$projects = $projectsModel->paginate($this->perPage);
			$showPagination = true;
		}
		else {
			$projects = $projectsModel->take(6)->get();
			$showPagination = false;
		}

		$returnHTML = view('projects.list', compact('projects', 'showPagination'))->render();
		return response()->json( array('success' => true, 'html' => $returnHTML) );
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
