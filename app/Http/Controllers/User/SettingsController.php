<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\LinksRequest;
use App\User;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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
	    $user = User::findOrFail($this->user->id);
        return view('user.settings.index', compact('user'));
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
	    if (\Input::hasFile('avatar'))
		{
		    $user->deleteImage();

		    $image = Input::file('avatar');
		    $filenameBig = $user->id. '_300' . '.'. $image->getClientOriginalExtension();
		    $filenameSmall = $user->id . '_28' . '.'. $image->getClientOriginalExtension();

			$publicDirName = '/static/uploads/avatar/' . date("Y") . '/' . date("m"). '/'. date("d");
			$dirName = public_path($publicDirName);
			if (!\Illuminate\Support\Facades\File::exists($dirName)) {
				\Illuminate\Support\Facades\File::makeDirectory($dirName, 0755, true);
			}

			$pathBig = $dirName . '/' . $filenameBig;
			$pathSmall = $dirName . '/' . $filenameSmall;

//		    TODO: do crop
		    \Image::make($image->getRealPath())->fit(258, 258)->save($pathBig);
		    \Image::make($image->getRealPath())->fit(28, 28)->save($pathSmall);
		    $user->avatar = json_encode(
				[
					'path'	=> $publicDirName,
					's'		=> $filenameSmall,
					'b'		=> $filenameBig
				]
			);
		    $user->save();
		    \Session::flash('success.message', "Your profile picture has been successfully updated.");
		    if ($request->ajax()) {
			    return response()->json(['success' => true, 'redirect' => url('user/settings')]);
		    }
	    }
	    else {
		    $user->update($request->all());
	    }

	    if ($request->ajax()) {
		    return response()->json(['success' => true, 'message' => "Your Settings has been successfully updated."]);
	    }
	    else {
		    \Session::flash('success.message', "Your Settings has been successfully updated.");
		    return redirect()->back()->withInput();
	    }
    }

	public function getChangePassword()
	{
		return view('user.settings.password');
	}

	public function postChangePassword(Request $request)
	{
		$this->validate($request, [
			'old_password' => 'required',
			'password' => 'required|confirmed|min:6',
		]);

		$data = $request->all();
		if (!Hash::check($data['old_password'], $this->user->password)) {
			if ($request->ajax()) {
				return response()->json(['old_password' => ['Incorrect password.']], 422);
			}
			else {
				return redirect()->back()->withErrors(['old_password' => 'Wrong password.']);
			}
		}

		$this->user->password = $data['password'];
		$this->user->save();

		\Session::flash('success.message', "Your password has been successfully changed.");
		if ($request->ajax()) {
			return response()->json(['success' => true, 'redirect' => url('user/settings')]);
		}
		return redirect()->back();

	}

	public function getAboutMe()
	{
		return view('user.settings.about');
	}

	public function getAvatar()
	{
		return view('user.settings.avatar');
	}

	public function getLinks()
	{
		return view('user.settings.links');
	}

	public function postLinks(LinksRequest $request)
	{
		$link = $request->input('link');
		$user = User::findOrFail($this->user->id);
		$links = $user->links;
		$links[] = $link;
		$user->links = $links;
		$user->save();
		\Session::flash('success.message', "Your Settings has been successfully updated.");
		if ($request->ajax()) {
			return response()->json(['success' => true, 'redirect' => url('user/settings')]);
		}
	}


}
