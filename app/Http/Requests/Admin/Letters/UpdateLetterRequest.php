<?php namespace App\Http\Requests\Admin\Letters;

use App\Http\Requests\Request;

class UpdateLetterRequest extends Request
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
	    $id = $this->route()->getParameter('letters');
	    return [
			'name' => 'required',
			'slug' => 'required|unique:letters,slug,' . $id,
			'subject' => 'required',
			'content' => 'required',
		];
    }

}
