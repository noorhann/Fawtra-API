<?php

namespace App\Http\Controllers;

use App\Models\SpeedIndex;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SpeedIndexController extends Controller
{
    public function index()
    {
        $speed = SpeedIndex::get();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'speed' =>  $speed,
        ],200);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'speed' => 'required',    
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,
                                    'message'=>$validator->errors(),
                                    'code'=>400],400);
        }
        $s= new SpeedIndex();
        $s->speed = $request->speed;
        $s->save();

        return response()->json([
            'status'=>true,
            'code'=>201,
            'speed' => $s,
        ],201);

    }

    public function delete($id)
    {
        $s = SpeedIndex::where('id',$id)->firstorfail()->delete();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' =>"SpeedIndex deleted successfully",
        ],200);
    }
}
