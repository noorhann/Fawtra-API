<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function AddCar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'manufacturing' => 'required|regex:/^[A-Za-z]+$/',            
            'registration' => 'required',            
            'manufacturing_date' => 'required',            
            'chassis' => 'required|unique:cars,chassis',            
            'model' => 'required',            
            'customer_id'=> 'required',  
            'reg_chars'=>'required' 
        
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,'message'=>$validator->errors(),'code'=>400],400);
        }

        $manufacturing = $request->manufacturing;
		$registration = $request->registration;
		$manufacturing_date = $request->manufacturing_date;
		$chassis = $request->chassis;
		$model = $request->model;
        $customer_id=$request->customer_id;
        $reg_chars=$request->reg_chars;
	    
        $car = new Car;
		$car->manufacturing = $manufacturing;
		$car->registration = $registration;
		$car->manufacturing_date = $manufacturing_date;
		$car->chassis = $chassis;
		$car->model = $model;
		$car->customer_id=$customer_id;
		$car->reg_chars=$reg_chars;

		$car->save();

        return response()->json(['status'=>true,
        'message'=>trans('car created successfully'),
        'code'=>201,
        'data'=>$car,
        ],201);
			
    }

    public function updateCar($id,Request $request)
    {
        $car=Car::where('id',$id)->first();
        if (!$car)
        {
            return response()->json(['status'=>false,
            'message'=>trans('Not found car'),
            'code'=>404,
            ],404);
        }

        $validator = Validator::make($request->all(), [
            'manufacturing' => 'required|regex:/^[A-Za-z]+$/',            
            'registration' => 'required',            
            'manufacturing_date' => 'required',            
            'model' => 'required',            
            'customer_id'=> 'required',  
            'reg_chars'=>'required' ,
            'chassis' => ['required','unique:cars,chassis,'.$car->id],

        ]);
        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,'message'=>$validator->errors(),'code'=>400],400);
        }

        $car->manufacturing =$request->input('manufacturing');
		$car->registration = $request->input('registration');
		$car->manufacturing_date = $request->input('manufacturing_date');
		$car->chassis = $request->input('chassis');
		$car->model =$request->input('model');
		$car->customer_id =$request->input('customer_id');
		$car->reg_chars=$request->input('reg_chars');

        $car->save();

        return response()->json(['status'=>true,
                                'message'=>trans('car updated successfully'),
                                'code'=>200,
                                'data'=>$car,
                            ],200);

    }

    public function delete($id)
    {
        $car = Car::where('id',$id)->firstorfail()->delete();
        
        return response()->json([
            'status'=>true,
            'message'=>'Car deleted successfully',
            'code'=>200,
        ],200);
    }

    public function search($id,Request $request)
    {
        $keyword = $request->input('keyword');
        $car=Car::where('customer_id',$id)->where(function ($query) use($keyword) {
            $query->where('manufacturing', 'like', '%' . $keyword . '%')
               ->orWhere('registration', 'like', '%' . $keyword . '%')
               ->orWhere('manufacturing_date', 'like', '%' . $keyword . '%')
               ->orWhere('chassis', 'like', '%' . $keyword . '%')
               ->orWhere('model', 'like', '%' . $keyword . '%')
               ->orWhere('id', 'like', '%' . $keyword . '%')
               ->orWhere('reg_chars', 'like', '%' . $keyword . '%');

          })
            ->get();
        if (!$car)
        {
            return response()->json(['status'=>false,
                'message'=>trans('No data found '),
                'code'=>404,
                ],404);
        }
            
        return response()->json([
                'status'=>true,
                'message'=>'search result',
                'code'=>200,
                'data'=>$car,
            ],200);

    }
}
