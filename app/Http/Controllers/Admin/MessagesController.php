<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mailers\AppMailer;
use App\User;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use App\Message;
use App\Http\Requests\Admin\Messages\CreateMessageRequest;
use App\Http\Requests\Admin\Messages\UpdateMessageRequest;

class MessagesController extends Controller
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
        $messages = Message::with(['from', 'to'])->latest()->paginate(20);


        $no = $messages->firstItem();


        return view('admin.messages.index', compact('messages', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateMessageRequest $request, Guard $auth, AppMailer $mailer)
    {
        $data = $request->all();
	    $data['from_user_id'] = $auth->user()->id;
	    $message = Message::create($data);

	    $mailer->sendSimpleEmailTo($message->to_user_id, $message);
        return redirect()->action('Admin\MessagesController@user', ['id' => $data['to_user_id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);
	    $message->is_viewed = 1;
	    $message->save();

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        
        $message->delete();
    
        return redirect()->route('admin.messages.index');
    }


	public function user($userId, Guard $auth)
	{
		$messages = Message::where('from_user_id', $userId)->orWhere('to_user_id', $userId)->latest()->paginate(20);

		$user = User::findOrFail($userId);
		return view('admin.messages.user', compact('messages', 'user'));
	}

}
