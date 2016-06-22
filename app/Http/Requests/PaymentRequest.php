<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PaymentRequest extends Request
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
            'amount' => 'required|numeric|min:1',
	        'project_id' => 'required|numeric',
	        'cardholder'    => 'required_if:pay-method,credit_card',
	        'cardnumber'    => 'required_if:pay-method,credit_card|digits:16',
	        'card-month'    => 'required_if:pay-method,credit_card',
	        'card-year'    => 'required_if:pay-method,credit_card',
	        'cvn'           => 'required_if:pay-method,credit_card|numeric',
        ];
    }
}
