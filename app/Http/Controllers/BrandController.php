<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index()
    {
        $Brand = Brand::get();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'Brand' =>  $Brand,
        ],200);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand' => 'required',    
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,
                                    'message'=>$validator->errors(),
                                    'code'=>400],400);
        }
        $b= new Brand();
        $b->brand = $request->brand;
        $b->save();

        return response()->json([
            'status'=>true,
            'code'=>201,
            'Brand' =>  $b,
        ],201);

    }

    public function delete($id)
    {
        $Brand = Brand::where('id',$id)->firstorfail()->delete();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' =>"Brand deleted successfully",
        ],200);
    }
}
