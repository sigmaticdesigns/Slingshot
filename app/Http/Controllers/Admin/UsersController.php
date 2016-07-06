<?php
/**
 * Created by PhpStorm.
 * User: esab
 * Date: 5/10/16
 * Time: 10:08 PM
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\User;

class UsersController extends \Pingpong\Admin\Controllers\UsersController
{

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * ban or activate user
	 */
	public function postSetStatus(Request $request)
	{
		$status = $request->input('status', User::STATUS_BANNED);
		$id = (int) $request->input('id');
		$user = User::findOrFail($id);
		$user->status = $status;
		$user->save();

		$result = ['result' => 1, 'status' => $status];
		return response()->json($result);
	}

	/**
	 * Display the specified user.
	 *
	 * @param int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		try {
			$user = User::findOrFail($id);

			return $this->view('users.show', compact('user'));
		} catch (ModelNotFoundException $e) {
			return $this->redirectNotFound();
		}
	}

	public function postSendMessage(Request $request)
	{
		$userId = $request->input('user_id');
		return $this->redirect('users.show', $userId);
	}
}