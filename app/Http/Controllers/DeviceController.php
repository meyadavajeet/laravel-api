<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    /**
     * @getAllDevice
     * @getDeviceById
     */
    public function getDeviceList($id = null)
    {
        $res = $id ? Device::find($id) : Device::all();
        if ($res === null) {
            return ["result" => "Record Not Found with id : $id"];
        }
        return $res;
    }

    /**
     * @Author Ajeet
     * Create New Device
     */
    public function addDevice(Request $request)
    {
        $device = new Device();
        $device->name = $request->name;
        $device->member_id = $request->member_id;
        $result = $device->save();
        if ($result) {
            return ["result" => "Device data has been saved"];
        }
        return ["result" => "operation failed"];
    }

    /**
     * Update Device
     */
    public function updateDevice(Request $request)
    {
        $device = Device::find($request->id);
        $device->name = $request->name;
        $device->member_id = $request->member_id;
        $result = $device->save();
        if ($result) {
            return ["result" => "Device data has been updated successfully!!!"];
        }
        return ["result" => "Update operation has been failed !!!"];
    }

    public function searchDevice($name)
    {
        $result = Device::where('name', 'like', '%' . $name . '%')->get();
        if (count($result) > 0) {
            return $result;
        } else {
            return ['result' => 'No records found!!!'];
        }
    }

    public function deleteDevice($id)
    {
        $device = Device::find($id);
        if ($device !== null) {
            $result = $device->delete();
            if ($result) {
                return ["result" => "Record has been deleted"];
            }
            return ["result" => "delete operation has been failed"];
        }
        return ['result' => "No records found with id : $id"];
    }


    public function validateAndSave(Request $request)
    {
        $rules = array(
            "member_id" => "required|min:1|max:4",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 402); //validation error
        } else {
            $device = new Device();
            $device->name = $request->name;
            $device->member_id = $request->member_id;
            $result = $device->save();
            if ($result) {
                return ["result" => "Device data has been saved"];
            }
            return ["result" => "operation failed"];
        }
    }

    // upload file
    public function uploadFile(Request $request)
    {
        $result = $request->file('fileName')->store('uploads');
        return ['result' => $result];
    }
}
