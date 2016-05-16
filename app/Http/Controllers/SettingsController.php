<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SettingsController extends Controller
{
	protected $user;

	public function __construct(Guard $auth)
	{
		$this->user = $auth->user();
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request)
    {
        $user = User::findOrFail($this->user->id);
	    if (\Input::hasFile('avatar')) {
		    $user->deleteImage();

		    $image = Input::file('avatar');
		    $filename = $user->id . '.'. $image->getClientOriginalExtension();
		    $path = public_path('img/avatar/' . $filename);

//		    TODO: do crop
		    \Image::make($image->getRealPath())->resize(200, 200)->save($path);
		    $user->avatar = $filename;
		    $user->save();
	    }
	    else {
		    $user->update($request->all());
	    }

	    \Session::flash('success.message', "Your Settings has been successfully updated.");
	    return redirect()->back()->withInput();
    }

	public function getChangePassword()
	{

	}

	public function postChangePassword()
	{

	}

	public function getAboutMe()
	{
		return view('settings.about');
	}

	public function getAvatar()
	{
		return view('settings.avatar');
	}


}
