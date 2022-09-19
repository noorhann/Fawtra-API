<?php

namespace App\Http\Controllers;

use App\Models\Height;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HeightController extends Controller
{
    public function index()
    {
        $Height = Height::get();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'Height' =>  $Height,
        ],200);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'height' => 'required',    
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,
                                    'message'=>$validator->errors(),
                                    'code'=>400],400);
        }
        $h= new Height();
        $h->height = $request->height;
        $h->save();

        return response()->json([
            'status'=>true,
            'code'=>201,
            'Height' =>  $h,
        ],201);

    }

    public function delete($id)
    {
        $Height = Height::where('id',$id)->firstorfail()->delete();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' =>"height deleted successfully",
        ],200);
    }
}
