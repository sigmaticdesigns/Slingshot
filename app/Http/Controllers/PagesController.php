<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{


	public function __construct()
	{
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

	    $page = Page::where('slug', $slug)->first();
	    if ($page) {

		    if ('html' == $page->template) {
			    return view('pages.html', compact('page'));
		    }
		    else {
			    return view('pages.template', compact('page'));
		    }
	    }
	    else {
		    return view('404');
	    }
	    dd($page);
    }

}
