<?php namespace App\Http\Requests\Projects;

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
			'name' => 'required',
			'category_id' => 'required',
			'budget' => 'required',
			'description' => 'required',
			'file_id' => 'required',
			'deadline' => 'required',
			'half_deadline' => 'required',
		];
    }

}
