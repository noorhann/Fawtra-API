<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function index()
    {
        $branch =Location::get();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'Branch' =>  $branch,
        ],200);
    }

    
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch' => 'required',    
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,
                                    'message'=>$validator->errors(),
                                    'code'=>400],400);
        }
        $b= new Location();
        $b->branch = $request->branch;
        $b->save();

        return response()->json([
            'status'=>true,
            'code'=>201,
            'Branch' =>  $b,
        ],201);

    }

    public function delete($id)
    {
        $Branch = Location::where('id',$id)->firstorfail()->delete();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' =>"Branch deleted successfully",
        ],200);
    }
}
