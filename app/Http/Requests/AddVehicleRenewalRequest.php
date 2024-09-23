<?php
// app/Http/Requests/AddVehicleRenewalRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddVehicleRenewalRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // Adjust as necessary
    }

    public function rules()
    {
        return [
            'category' => 'required',
            'vehiclemake' => 'required',
            'vehiclemodel' => 'required',
            'platenumber' => 'required',
            'vehiclecolor' => 'required',
            'vehiclename' => 'required',
            'ownersphonenumber' => 'required',
            'vehiclelicensepapers' => 'mimes:jpeg,docx,pdf,doc,jpg,png|max:2024',
            'insurancepapers' => 'mimes:jpeg,jpg,docx,pdf,doc,png|max:2024',
            'roadworthinesspapers' => 'mimes:jpeg,docx,pdf,doc,jpg,png|max:2024',
            'meansofid' => 'mimes:jpeg,docx,pdf,doc,jpg,png|max:2024',
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'The Category is required',
            'vehiclemake.required' => 'The Vehicle Make is required',
            'vehiclemodel.required' => 'The Vehicle Model is required',
            'platenumber.required' => 'The Plate Number is required',
            'vehiclecolor.required' => 'The Vehicle Color is required',
            'vehiclename.required' => 'The Vehicle License is required',
            'ownersphonenumber.required' => 'The Owner’s Phone Number is required',
            'vehiclelicensepapers.mimes' => 'Upload the right file format (jpeg,jpg,docx,doc,pdf,png)',
            'insurancepapers.mimes' => 'Upload the right file format (jpeg,jpg,docx,doc,pdf,png)',
            'roadworthinesspapers.mimes' => 'Upload the right file format (jpeg,jpg,docx,doc,pdf,png)',
            'meansofid.mimes' => 'Upload the right file format (jpeg,jpg,docx,doc,pdf,png)',
        ];
    }
}
