<?php

namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mailers\AppMailer;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use App\Message;
use App\Http\Requests\User\Messages\CreateMessageRequest;
use App\Http\Requests\User\Messages\UpdateMessageRequest;

class MessagesController extends Controller
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
        $messages = Message::where('from_user_id', $this->user->id)->orWhere('to_user_id', $this->user->id)->latest()->paginate(20);

        $no = $messages->firstItem();

        return view('user.messages.index', compact('messages', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('user.messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateMessageRequest $request, AppMailer $mailer)
    {
	    $data = $request->all();
	    $data['from_user_id'] = $this->user->id;
	    $lastMessage = Message::where('to_user_id', $this->user->id)->latest()->first();
	    $data['to_user_id'] = $lastMessage ? $lastMessage->from_user_id : 1;
	    $message = Message::create($data);
	    $mailer->sendSimpleEmailTo($data['to_user_id'], $message);

	    \Session::flash('success.message', "Message has been sent.");
	    if ($request->ajax()) {
		    return response()->json(['success' => true, 'redirect' => route('user.messages.index')]);
	    }
	    else {
		    return redirect()->back()->withInput();
	    }
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

        return view('user.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(CreateMessageRequest $request, $id)
    {       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
//        $message = Message::findOrFail($id);
//
//        $message->delete();
    
        return redirect()->route('user.messages.index');
    }

}
