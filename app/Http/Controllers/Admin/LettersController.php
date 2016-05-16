<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Letter;
use App\Http\Requests\Admin\Letters\CreateLetterRequest;
use App\Http\Requests\Admin\Letters\UpdateLetterRequest;

class LettersController extends Controller
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
        $letters = Letter::latest()->paginate(20);

        $no = $letters->firstItem();

        return view('admin.letters.index', compact('letters', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.letters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateLetterRequest $request)
    {
        $letter = Letter::create($request->all());

        return redirect()->route('admin.letters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $letter = Letter::findOrFail($id);

        return view('admin.letters.show', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $letter = Letter::findOrFail($id);
    
        return view('admin.letters.edit', compact('letter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateLetterRequest $request, $id)
    {       
        $letter = Letter::findOrFail($id);

        $letter->update($request->all());

        return redirect()->route('admin.letters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $letter = Letter::findOrFail($id);
        
        $letter->delete();
    
        return redirect()->route('admin.letters.index');
    }

}
