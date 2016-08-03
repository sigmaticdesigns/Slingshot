<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Pingpong\Admin\Entities\Option;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
	    $slider = Option::findByKey('index.slider')->first();
	    if ($slider) {
		    $slider = json_decode($slider->value);
	    }
	    return view('admin.options.index', compact('slider'));
    }

	/**
	 * Update the settings.
	 *
	 * @return mixed
	 */
	public function updateSettings()
	{
		$settings = \Input::all();

		if (Input::has('index_title'))
		{
			if (!isset($settings['index_slider'])) {
				$settings['index_slider'] = [];
			}

			if (\Input::hasFile('image'))
			{
				$image = Input::file('image');
				$filename = time() . '.' . $image->getClientOriginalExtension();

				$publicDirName = '/static/uploads/home/' . date("Y") . '/' . date("m");
				$dirName = public_path($publicDirName);
				if (!\Illuminate\Support\Facades\File::exists($dirName)) {
					\Illuminate\Support\Facades\File::makeDirectory($dirName, 0755, true);
				}

				$path = $dirName . '/' . $filename;
				\Image::make($image->getRealPath())->fit(1905, 540)->save($path);

				array_unshift($settings['index_slider'], $publicDirName . '/' . $filename);
			}
			$settings['index_slider'] = json_encode($settings['index_slider']);
		}

		/*upload site logo*/
		if (Input::hasFile('site_logo'))
		{
			$image = Input::file('site_logo');
			$filename = time() . '.' . $image->getClientOriginalExtension();

			$publicDirName = '/static/uploads/logo/' . date("Y") . '/' . date("m");
			$dirName = public_path($publicDirName);
			if (!File::exists($dirName)) {
				File::makeDirectory($dirName, 0755, true);
			}

			$path = $dirName . '/' . $filename;
			\Image::make($image->getRealPath())->fit(149, 39)->save($path);

			$settings['site.logo'] = $publicDirName . '/' . $filename;
		}

		foreach ($settings as $key => $value)
		{
			$option = str_replace('_', '.', $key);

			$model = Option::firstOrNew(['key' => $option]);
			$model->value = $value;
			$model->save();
		}

		return \Redirect::back()->withFlashMessage('Settings has been successfully updated!');
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
