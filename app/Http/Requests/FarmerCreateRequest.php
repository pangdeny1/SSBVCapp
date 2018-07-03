<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FarmerCreateRequest extends FormRequest
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
            "first_name" => "required",
            "last_name" => "required",
            "phone" => "required",
            "email" => "nullable|email",
            "gender" => ["required", Rule::in(["male","female"])],

            "size" => "required|numeric",
            "size_unit" => "required",
            
            "street" => "required",
            "country" => "required",

            "crops" => "required|array",
            "crops.*" => "required|exists:crops,id",
            "block_id" => "required|exists:blocks,id",
        ];
    }
}