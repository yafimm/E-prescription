<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionRequest extends FormRequest
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
        if($this->method() == 'POST'){
           $patientName = 'required|string|min:4|max:50|unique:products,name';
           $files = 'required|array|min:1|max:3';
        }else{
           $name = 'required|string|min:4|max:50|unique:products,name,'.$this->get('id');
           $files = 'sometimes|required|array|min:1|max:3';
        }

        return [
          'patient_name'       => $patienName,
          'patient_age'        => $patientAge,
          'patient_gender'     => $patientGender ,
          'prescription_items' => 'array|min:1|required',
          'size_id'            => 'array|required_unless:category_id,1|min:1',
          'product_id'  => 'required_if:category_id,1|array|min:2',
          'files'       => $files,
          'files.*'     => 'dimensions:ratio=1/1',
          'barcode'     => 'sometimes',
          'weight'      => 'required|numeric'
        ];
    }
}
