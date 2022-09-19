<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class YearController extends Controller
{
    public function index()
    {
        $Year = Year::get();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'Year' =>  $Year,
        ],200);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required',    
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,
                                    'message'=>$validator->errors(),
                                    'code'=>400],400);
        }
        $y= new Year();
        $y->year = $request->year;
        $y->save();

        return response()->json([
            'status'=>true,
            'code'=>201,
            'year' =>  $y,
        ],201);

    }

    public function delete($id)
    {
        $year = Year::where('id',$id)->firstorfail()->delete();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' =>"Year deleted successfully",
        ],200);
    }
}
