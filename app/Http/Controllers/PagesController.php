<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

	protected $repository;

	public function __construct()
	{
		$this->repository = $this->getRepository();
	}

	/**
	 * Get repository instance.
	 *
	 * @return mixed
	 */
	public function getRepository()
	{

		$repository = 'Pingpong\Admin\Repositories\Pages\PageRepository';
		return app($repository);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug = '')
    {
	    $page = $this->repository->getPage()->where('slug', $slug)->first();
	    if ($page) {
		    return view('page', compact('page'));
	    }
	    else {
		    return view('404');
	    }
	    dd($page);
    }

}
