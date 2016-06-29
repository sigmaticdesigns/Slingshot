<?php namespace App\Http\Requests\Admin\Pages;

use App\Http\Requests\Request;

class UpdatePageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'title' => 'required',
			'slug' => 'required',
			'section' => 'required',
			'template' => 'required',
			'body' => 'required',
		];
    }

}
