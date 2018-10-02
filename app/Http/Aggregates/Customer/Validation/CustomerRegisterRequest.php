<?php namespace App\Http\Requests;

class CustomerRegisterRequest extends Request
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
            'last_name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('customer.name_required'),
            'last_name.required' => trans('customer.last_name_required'),
            'username.required' => trans('customer.username_required'),
            'password.required' => trans('customer.password_required'),
        ];
    }
}
