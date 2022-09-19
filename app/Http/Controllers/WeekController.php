<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\Height;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WeekController extends Controller
{
    public function index()
    {
        $week = Week::get();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'weeks' =>  $week,
        ],200);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'week' => 'required',    
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,
                                    'message'=>$validator->errors(),
                                    'code'=>400],400);
        }
        $w= new Week();
        $w->week = $request->week;
        $w->save();

        return response()->json([
            'status'=>true,
            'code'=>201,
            'weeks' =>  $w,
        ],201);

    }

    public function delete($id)
    {
        $week = Week::where('id',$id)->firstorfail()->delete();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' =>"week deleted successfully",
        ],200);
    }
}
