<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class UserRequest extends FormRequest
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
            'email' => 'required',
            'username' => 'required',
            'phone' => 'required',
            'website' => 'required',
        ];
    }

    /**
     * Is valid data of this Model
     *
     * @param Array $data
     *
     * @return bool
     */
    public function isValidProduct($data)
    {
        $validator = Validator::make($data, $this->rules());
        return !$validator->fails();
    }
}
