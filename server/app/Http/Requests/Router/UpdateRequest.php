<?php

namespace App\Http\Requests\Router;

use App\Models\Router;
use App\Rules\HostnameRule;
use App\Rules\MacAddressRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateRequest extends FormRequest
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
            'sap_id' => 'numeric|digits_between:1,18',
            'loopback' => [
                "required",
                "ipv4",
                Rule::unique('routers', 'loopback')->ignore($this->router)->where('hostname', $this->hostname)
            ],
            'hostname' => [
                "required",
                "max:50",
                new HostnameRule(),
                Rule::unique('routers', 'hostname')->ignore($this->router)->where('loopback', $this->loopback)
            ],
            'mac_address' => [
                "required",
                "max:17",
                new MacAddressRule(),
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json([
            'code' => 'VALIDATION_ERROR',
            'errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

}
