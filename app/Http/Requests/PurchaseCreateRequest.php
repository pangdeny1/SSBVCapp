<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseCreateRequest extends FormRequest
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
            "weight_unit" => "required|in:kg,g,t",
            "product_id" => "required|exists:products,id",
            "farmer_id" => "required|exists:farmers,id",
            "amount" => "nullable|numeric",
            "field_weight" => "numeric|required",
            "weight_before" => "required|numeric",
            "weight_after" => "nullable|numeric",
            "remarks" => "nullable",
        ];
    }
}