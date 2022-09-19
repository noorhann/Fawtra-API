<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CountryOriginal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CountryOriginalController extends Controller
{
    public function index()
    {
        $country = CountryOriginal::get();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'country' =>  $country,
        ],200);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'required',    
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,
                                    'message'=>$validator->errors(),
                                    'code'=>400],400);
        }
        $c= new CountryOriginal();
        $c->country = $request->country;
        $c->save();

        return response()->json([
            'status'=>true,
            'code'=>201,
            'diameter' => $c,
        ],201);

    }

    public function delete($id)
    {
        $country  = CountryOriginal::where('id',$id)->firstorfail()->delete();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' =>"country  deleted successfully",
        ],200);
    }
}