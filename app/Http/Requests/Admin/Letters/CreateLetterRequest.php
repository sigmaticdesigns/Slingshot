<?php namespace App\Http\Requests\Admin\Letters;

use App\Http\Requests\Request;

class CreateLetterRequest extends Request
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
			'slug' => 'required|unique:letters',
			'subject' => 'required',
			'content' => 'required',
		];
    }

}
