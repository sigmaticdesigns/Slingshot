<?php namespace App\Http\Requests\User\Projects;

use App\Http\Requests\Request;

class CreateProjectRequest extends Request
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
			'name' => 'required',
			'category_id' => 'required',
			'budget' => 'required',
			'description' => 'required',
//			'body' => 'required',
			'file' => 'required',
			'deadline' => 'required',
			'half_deadline' => 'required',
		];
    }

}