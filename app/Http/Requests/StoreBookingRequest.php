<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'BookerName' => 'required|string|max:100',
            'VehicleID' => 'required|exists:vehicles,VehicleID',
            'DriverID' => 'required|exists:company_drivers,DriverID',
            'BookingDate' => 'required|date',
            'BranchManagerID' => 'required|exists:branch_managers,ManagerID',
            'HeadOfficeManagerID' => 'required|exists:head_office_managers,HeadManagerID',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'BookerName.required' => 'The booker name is required.',
            'VehicleID.required' => 'The vehicle ID is required.',
            'VehicleID.exists' => 'The selected vehicle ID is invalid.',
            'DriverID.required' => 'The driver ID is required.',
            'DriverID.exists' => 'The selected driver ID is invalid.',
            'BookingDate.required' => 'The booking date is required.',
            'BookingDate.date' => 'The booking date must be a valid date.',
            'BranchManagerID.required' => 'The branch manager ID is required.',
            'BranchManagerID.exists' => 'The selected branch manager ID is invalid.',
            'HeadOfficeManagerID.required' => 'The head office manager ID is required.',
            'HeadOfficeManagerID.exists' => 'The selected head office manager ID is invalid.',
        ];
    }
}
