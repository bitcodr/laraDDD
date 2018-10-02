<?php namespace App\Http\Requests;


class AddressBookRequest extends Request
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
                  'title' => 'required',
                  'address' => 'required',
                  'latitude' => 'required',
                  'longitude' => 'required'
              ];
    }

    public function messages()
    {
        return [
                  'type.required' => trans('addressBook.type_required'),
                  'type.in' => trans('addressBook.type_not_exist'),
                  'title.required' => trans('addressBook.title_required'),
                  'address.district.required' => trans('addressBook.address_required'),
                  'latitude.required' => trans('addressBook.latitude_required'),
                  'longitude.required' => trans('addressBook.longitude_required'),
        ];
    }


}
