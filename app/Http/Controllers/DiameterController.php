<?php

namespace App\Http\Controllers;

use App\Models\Diameter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DiameterController extends Controller
{
    public function index()
    {
        $Diameter = Diameter::get();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'Diameter' =>  $Diameter,
        ],200);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'diameter' => 'required',    
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,
                                    'message'=>$validator->errors(),
                                    'code'=>400],400);
        }
        $d= new Diameter();
        $d->diameter = $request->diameter;
        $d->save();

        return response()->json([
            'status'=>true,
            'code'=>201,
            'diameter' =>  $d,
        ],201);

    }

    public function delete($id)
    {
        $Diameter = Diameter::where('id',$id)->firstorfail()->delete();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' =>"Diameter deleted successfully",
        ],200);
    }
}
