<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
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
        $this->redirect = action('API\RegisterController@requestError', [
            'name' => $this->name ? $this->name : '',
            'address' => $this->address ? $this->address : ''
        ]);

        return [
            //
            'name' => 'required| min:3| max:50',
            'address' => 'required'
        ];
    }
}
