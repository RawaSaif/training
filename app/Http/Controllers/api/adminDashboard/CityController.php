<?php

namespace App\Http\Controllers\api\adminDashboard;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\api\BaseController as BaseController;

class CityController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $success['cities']=CityResource::collection(City::all());
        $success['status']= 200;
        
         return $this->sendResponse($success,'تم ارجاع المدن بنجاح','cities return successfully');
      
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $input = $request->all();
        $validator =  Validator::make($input ,[
            'name'=>'required',
            'name_en'=>'required',
             'country_id'=>'required'
        ]);
        if ($validator->fails()) 
        {
            return $this->sendError(null,$validator->errors());
        }
        $city = City::create([
            'name' => $request->name,
            'name_en'=>$request->name_en,
            'country_id' => $request->country_id,
          ]);
    
         // return new CountryResource($country);
         $success['countries']=New CityResource($city);
        $success['status']= 200;
        
         return $this->sendResponse($success,'تم إضافة منشور بنجاح','Post Added successfully');
    }
    

  
    public function show(City $city)
    {
        $city = City::query()->find($city->id);

        if (!$city) {
            return response()->json(['success' => false, 'message' => ' country does not exist']);
        }
    
        return response()->json(['success' => true, 'country' => new CityResource( $city )]);
    }
    public function changeStatus($id)
    {
        $city = City::query()->find($id);
if($city->status === 'active'){
    $city->update(['status' => 'not_active']);
}
else{
    $city->update(['status' => 'active']);
}
        $success['$countries']=New CityResource($city);
        $success['status']= 200;
        
         return $this->sendResponse($success,'تم إضافة منشور بنجاح','Post Added successfully');
    
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
         $input = $request->all();
        $validator =  Validator::make($input ,[
            'name'=>'required',
            'name_en'=>'required',
            'country_id'=>'required'
        ]);
        if ($validator->fails()) 
        {
            # code...
            return $this->sendError(null,$validator->errors());
        }
        $city->update(['name' => $request->input('name'),'name_en' => $request->input('name_en'),'country_id' => $request->input('country_id')]);
       //$country->fill($request->post())->update();
        $success['cities']=New CityResource($city);
        $success['status']= 200;
    
         return $this->sendResponse($success,'تم التعديل بنجاح','Post Added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        if($city->is_deleted === 0){
            $city->update(['is_deleted' => 1]);
        }
        else{
            $city->update(['is_deleted' => 0]);
        }
        $success['country']=New CityResource($city);
        $success['status']= 200;
        
         return $this->sendResponse($success,'تم حذف منشور بنجاح','Post Added successfully');
    }
}