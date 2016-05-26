<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\File as FileModel;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use App\Project;
use App\Http\Requests\User\Projects\CreateProjectRequest;
use App\Http\Requests\User\Projects\UpdateProjectRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class ProjectsController extends Controller
{
	protected $user;

	public function __construct(Guard $auth)
	{
		$this->user = $auth->user();
	}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
	    $user = User::findOrFail($this->user->id);
	    $projects = $user->projects()->latest()->paginate(20);

        $no = $projects->firstItem();

        return view('user.projects.index', compact('projects', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
	    $categoryList = Category::all(['id', 'name'])->pluck('name', 'id')->toArray();
	    return view('user.projects.create', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {
		$data = $request->all();
//	    file upload
//	    TODO: move to file uploader
		if (Input::hasFile('file'))
		{
			$image = Input::file('file');
			$filename  = Str::slug($data['name'], '_') . '_' . time() . '.' . $image->getClientOriginalExtension();
			$dirName = public_path('static/uploads/' . date("Y") . '/' . date("m"). '/'. date("d"));
			if (!\Illuminate\Support\Facades\File::exists($dirName)) {
				\Illuminate\Support\Facades\File::makeDirectory($dirName, 0755, true);
			}
			$path = $dirName . '/' . $filename;
//		    $img = Image::make($path);
			// crop image
			\Image::make($image->getRealPath())->crop(256, 187, 25, 25)->save($path);
			$file = FileModel::create([
				'type'  => 'image',
				'filename' => $filename,
				'path'  => $path
			]);
			$data['file_id'] = $file->id;
		}
		$data['user_id'] = $this->user->id;
		$data['status'] = Project::STATUS_PENDING;
		$project = Project::create($data);

		\Session::flash('success.message', "Project has been successfully created.");
		if ($request->ajax()) {
			return response()->json(['success' => true, 'redirect' => route('user.projects.index')]);
		}

        return redirect()->route('user.projects.index');
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

        return view('user.projects.show', compact('project'));
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
		$categoryList = Category::all(['id', 'name'])->pluck('name', 'id')->toArray();
    
        return view('user.projects.edit', compact('project', 'categoryList'));
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

        return redirect()->route('user.projects.index');
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
    
        return redirect()->route('user.projects.index');
    }

}
