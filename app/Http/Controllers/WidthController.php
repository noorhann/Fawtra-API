<?php

namespace App\Http\Controllers;

use App\Models\Width;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WidthController extends Controller
{
    public function index()
    {
        $width = Width::get();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'width' =>  $width,
        ],200);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'width' => 'required',    
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,
                                    'message'=>$validator->errors(),
                                    'code'=>400],400);
        }
        $w= new Width();
        $w->width = $request->width;
        $w->save();

        return response()->json([
            'status'=>true,
            'code'=>201,
            'width' =>  $w,
        ],201);

    }

    public function delete($id)
    {
        $width = Width::where('id',$id)->firstorfail()->delete();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' =>"width deleted successfully",
        ],200);
    }
}
