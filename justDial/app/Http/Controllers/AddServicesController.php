<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addServices;

class AddServicesController extends Controller
{
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function storeServices(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'desc'  => 'required|string'
        ]);
        $addData = new addServices();
        $addData->sServiceName = $request['name'];
        $addData->sDescription = $request['desc'];
        if ($addData->save()) {
            return redirect()->route('adminWelcome');
        }

        return redirect()->back()->withErrors($validator)->withInput();
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *  
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function viewService()
    {
        $serviceData = addServices::all();
        return view('admin.serviceList', ['serviceData'=> $serviceData]);
    }
}
