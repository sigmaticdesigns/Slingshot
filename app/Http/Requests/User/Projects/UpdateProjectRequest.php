<?php namespace App\Http\Requests\User\Projects;

use App\Http\Requests\Request;

class UpdateProjectRequest extends Request
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
			'name' => 'required|max:255',
			'category_id' => 'required',
//			'budget' => 'required|numeric|min:1',
			'description' => 'required|max:255',
			'body' => 'required',
			'file' => 'required|image',
		];
    }

}
