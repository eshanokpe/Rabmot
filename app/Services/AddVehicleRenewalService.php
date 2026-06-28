<?php
  // app/Services/VehicleRenewalService.php
namespace App\Services;

use Illuminate\Http\Request;

class AddVehicleRenewalService
{
    public function handleFileUpload(Request $request, $fileKey, $directory)
    {
        if ($request->hasFile($fileKey)) {
            $file = $request->file($fileKey);
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($directory), $filename);
            return $filename;
        }
        return null;
    } 
}
