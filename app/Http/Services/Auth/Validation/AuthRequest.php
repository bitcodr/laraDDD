<?php namespace App\Http\Requests;


class AuthRequest extends Request
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
            'username' => 'required',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => trans('auth.username_required'),
            'password.required' => trans('auth.password_required'),
            'password.min' => trans('auth.password_min_must_be_8'),
        ];
    }
}
