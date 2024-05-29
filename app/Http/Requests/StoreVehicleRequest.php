<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'VehicleID' => 'required|string|max:50|unique:vehicles,VehicleID',
            'VehicleModel' => 'required|string|max:100',
            'VehicleType' => 'required|in:Cargo,Passenger',
            'VehicleStatus' => 'required|in:Available,InService,Inactive',
            'FuelConsumptionPerKM' => 'required|numeric',
            'ServiceIntervalKM' => 'required|integer',
            'Ownership' => 'required|in:Company,Rented',
        ];
    }
}
