<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderPlaceRequest extends FormRequest
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
            // 'contact_person' => 'required|string',
            // 'contact_number' => 'required|digits_between:10,12',
            // 'address_line_0' => 'required|string|max:30',
            // 'address_line_1' => 'required|string|max:30',
            // 'address_line_2' => 'nullable|string|max:30',
            // 'pincode' => 'required|digits_between:6,6',
            // 'city' => 'required|string',
            // 'state'=> 'required|string',
            // //shipping address incase shipping is different
            // 'ship_contact_person' => 'nullable|required_with:ship_to_diff_add|string',
            // 'ship_contact_number' => 'nullable|required_with:ship_to_diff_add|digits_between:10,12',
            // 'ship_address_line_0' => 'nullable|required_with:ship_to_diff_add|string|max:30',
            // 'ship_address_line_1' => 'nullable|required_with:ship_to_diff_add|string|max:30',
            // 'ship_address_line_2' => 'nullable|string|max:30',
            // 'ship_pincode' => 'nullable|required_with:ship_to_diff_add|digits_between:6,6',
            // 'ship_city' => 'nullable|required_with:ship_to_diff_add|string',
            // 'ship_state'=> 'nullable|required_with:ship_to_diff_add|string',
            // //payment validation
            // 'utr_no' => 'nullable|string|min:16|max:16',
            // 'otp' => 'nullable|numeric'
        ];
    }
}
