<?php

namespace App\Http\Controllers;


use App\Category;
use App\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Input;


class ProjectsController extends Controller
{

	protected $perPage = 9;

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
	    if (Input::has('search')) {
		    $query = Input::get('search');
		    $projects = Project::active()->where('name', 'like', "%$query%")->latest()->paginate($this->perPage);
	    }
	    else {
		    $projects = Project::active()->latest()->paginate($this->perPage);
	    }



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
		if (Input::has('search')) {
			$query = Input::get('search');
			$projectsModel->where('name', 'like', "%$query%");
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

//	    TODO: refact
	    $backers = Payment::project($project->id)->latest()->get();
//	    dd($backers);
//	    $comments = $project->comments()->with('author');
	    $comments = $project->comments()->with('author')->get();
//	    $comments = Comment::where('project_id', $project->id)->with('author')->get();
//	    dd($comments);

        return view('projects.show', compact('project', 'backers', 'comments'));
    }



}
