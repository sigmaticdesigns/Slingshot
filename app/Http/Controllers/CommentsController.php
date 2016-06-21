<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests\Comments\CreateCommentRequest;
use App\Http\Requests\Comments\UpdateCommentRequest;

class CommentsController extends Controller
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
        $comments = Comment::latest()->paginate(20);

        $no = $comments->firstItem();

        return view('comments.index', compact('comments', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateCommentRequest $request)
    {
        $data = $request->all();
	    $data['user_id'] = $this->user->id;
	    $comment = Comment::create($data);

	    $returnHTML = view('comments.item', compact('comment'))->render();
	    return response()->json( array('success' => true, 'html' => $returnHTML) );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
    
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateCommentRequest $request, $id)
    {       
        $comment = Comment::findOrFail($id);

        $comment->update($request->all());

        return redirect()->route('comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        
        $comment->delete();
    
        return redirect()->route('comments.index');
    }

}
