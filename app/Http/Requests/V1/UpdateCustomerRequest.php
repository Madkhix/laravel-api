<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illumniate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
     {
        $user = $this->user();

        return $user != null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method === 'PUT') {
            return [
                'name' => 'required',
                'type' => 'required|in:I,B,i,b',
                'email' => 'required|email',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required|',
                'postalCode' => 'required',
            ];
        }
        if ($method === 'PATCH') {
            return [
                'name' => 'sometimes|required',
                'type' => 'sometimes|required|in:I,B,i,b',
                'email' => 'sometimes|required|email',
                'address' => 'sometimes|required',
                'city' => 'sometimes|required',
                'state' => 'sometimes|required|',
                'postalCode' => 'sometimes|required',
            ];
        }
        return [
            'name' => 'required',
            'type' => 'required|in:I,B,i,b',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required|',
            'postalCode' => 'required',
        ];
    }

    protected function prepareForValidation()
    {   
        if($this->postalCode){
            $this->merge([
                'postal_code' => $this->postalCode,
            ]);
        }
    }
}
