<?php namespace App\Http\Requests;

class SupplierRegisterRequest extends Request
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
            'name.required' => trans('supplier.name_required'),
            'last_name.required' => trans('supplier.last_name_required'),
            'username.required' => trans('supplier.username_required'),
            'password.required' => trans('supplier.password_required'),
        ];
    }
}
