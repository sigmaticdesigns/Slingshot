<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\Http\Requests\Admin\Projects\CreateProjectRequest;
use App\Http\Requests\Admin\Projects\UpdateProjectRequest;
use Illuminate\Support\Facades\Input;
use Pingpong\Admin\Entities\Category;

class ProjectsController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

	    if (Input::has('q')) {
		    $query = Input::get('q');
		    $projects = Project::where('name', 'like', "%$query%")->latest()->paginate(20);
	    }
	    else {
		    $projects = Project::latest()->paginate(20);
	    }

        $no = $projects->firstItem();

        return view('admin.projects.index', compact('projects', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {
        $project = Project::create($request->all());

        return redirect()->route('admin.projects.index');
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

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

	    $statusList = [
		    Project::STATUS_PENDING => Project::STATUS_PENDING,
		    Project::STATUS_DECLINED => Project::STATUS_DECLINED,
		    Project::STATUS_APPROVED => Project::STATUS_APPROVED
	    ];
	    $categoryList = Category::all(['id', 'name'])->pluck('name', 'id')->toArray();

        return view('admin.projects.edit', compact('project', 'statusList', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {       
        $project = Project::findOrFail($id);

        $project->update($request->all());

        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        
        $project->delete();
    
        return redirect()->route('admin.projects.index');
    }

	public function postSetStatus(Request $request)
	{
		$status = $request->input('status', Project::STATUS_DECLINED);
		$id = (int) $request->input('id');
		$project = Project::findOrFail($id);
		$project->status = $status;
		$project->save();

		$result = ['result' => 1, 'status' => $status];
		return response()->json($result);
	}

}
