<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
	/**
	 * Confirm a user's email address.
	 *
	 * @param  string $token
	 * @return mixed
	 */
	public function getConfirm($token)
	{
		User::whereToken($token)->firstOrFail()->confirmEmail();

		\Session::flash('success.message', "Thank You. Your email is confirmed.");

		return redirect('user/settings');
	}
}
