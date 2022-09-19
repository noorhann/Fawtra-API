<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tyre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TyreController extends Controller
{
    public function index(Request $request)
    {
        $tyres = Tyre::where('expire',0)->get();
        $date = Carbon::now();
        $week = $date->weekOfYear;
        $year =  substr($date->format('Y'), -2);

        foreach ($tyres as $t)
        {
            if($t->year + 2 == $year   && abs($t->week  + $week) <= 12)
            {
                $t->expire = 1 ;

            }
            elseif($t->year +2 < $year)
            {
                $t->expire = 1 ;

            }
            else 
            {
                $t->expire = 0 ;

            }
            $t->save();

    
        }
        
        $page_size=$request->page_size ?? 10 ;
        $tyre = Tyre::orderby('id','desc')->paginate($page_size);
        
        
        return response()->json([
            'status'=>true,
            'code'=>200,
            'tyres' =>  $tyre,
        ],200);
    }

    public function expire(Request $request)
    {
        $tyres = Tyre::where('expire',0)->get();
        $date = Carbon::now();
        $week = $date->weekOfYear;
        $year =  substr($date->format('Y'), -2);

        foreach ($tyres as $t)
        {
            if($t->year + 2 == $year   && abs($t->week  + $week) <= 12)
            {
                $t->expire = 1 ;

            }
            elseif($t->year +2 < $year)
            {
                $t->expire = 1 ;

            }
            else 
            {
                $t->expire = 0 ;

            }
            $t->save();

    
        }
        $page_size=$request->page_size ?? 10 ;

        $result = Tyre::where('expire',1)->paginate($page_size);
        return response()->json([
            'status'=>true,
            'code'=>200,
            'data'=>$result ,
            'week'=>$week,
        ],200);

    }
    public function show($id)
    {
        $tyre = Tyre::where('id',$id)->get();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'tyres' =>  $tyre,
        ],200);
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'width'=> 'required',
            'height'=> 'required',
            'diameter'=> 'required',
            'country_originals' => 'required',
            'speed_index'=> 'required',
            'quantity'=> 'required',
            'branch'=> 'required',
            'location'=> 'nullable',
            'note'=> 'nullable',
            'week'=> 'required',
            'year'=> 'required',
            'brand'=> 'required',
    
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,
                                    'message'=>$validator->errors(),
                                    'code'=>400],400);
        }

        $date = Carbon::now();
        $week = $date->weekOfYear;
        $year =  substr($date->format('Y'), -2);

       
          

    
       
        $t= new Tyre();
        $t->width = $request->width;
        $t->height = $request->height;
        $t->diameter = $request->diameter;
        $t->country_originals = $request->country_originals;
        $t->speed_index = $request->speed_index;
        $t->quantity = $request->quantity;
        $t->branch = $request->branch;
        $t->location = $request->location;
        $t->note = $request->note;
        $t->week = $request->week;
        $t->year = $request->year;
        $t->brand = $request->brand;

        if($request->year + 2 == $year   && abs($request->week  + $week) >= 12)
        {
            $t->expire = 1 ;

        }
        elseif($request->year +2 < $year)
        {
            $t->expire = 1 ;

        }
        else 
        {
            $t->expire = 0 ;

        }
        $t->save();

        return response()->json([
            'status'=>true,
            'code'=>201,
            'weeks' =>  $t,
        ],201);

    }

    public function update(Request $request,$id)
    {
          $t = Tyre::where('id',$id)->first();
          $date = Carbon::now();
          $week = $date->weekOfYear;
          $year =  substr($date->format('Y'), -2);
          if($t)
          {
            $validator = Validator::make($request->all(), [
                'width'=> 'required',
                'height'=> 'required',
                'diameter'=> 'required',
                'country_originals' => 'required',
                'speed_index'=> 'required',
                'quantity'=> 'required',
                'branch'=> 'required',
                'location'=> 'nullable',
                'note'=> 'nullable',
                'week'=> 'required',
                'year'=> 'required',
                'brand'=> 'required',
        
            ]);
    
            if ($validator->fails()) 
            {
                return response()->json(['status'=>false,
                                        'message'=>$validator->errors(),
                                        'code'=>400],400);
            }
            
            $t->width = $request->width;
            $t->height = $request->height;
            $t->diameter = $request->diameter;
            $t->country_originals = $request->country_originals;
            $t->speed_index = $request->speed_index;
            $t->quantity = $request->quantity;
            $t->branch = $request->branch;
            $t->location = $request->location;
            $t->note = $request->note;
            $t->week = $request->week;
            $t->year = $request->year;
            $t->brand = $request->brand;
            if($request->year + 2 == $year   && abs($request->week  + $week) >= 12)
            {
                $t->expire = 1 ;
    
            }
            elseif($request->year +2 < $year)
            {
                $t->expire = 1 ;
    
            }
            else 
            {
                $t->expire = 0 ;
    
            }
            $t->save();
    
            return response()->json([
                'status'=>true,
                'code'=>201,
                'weeks' =>  $t,
            ],201);
          }

          else 
          {
            return response()->json([
                'status'=>false,
                'code'=>404,
                'message' =>"id not found",
            ],404);
          }
    }

    public function delete($id)
    {
        $Tyre = Tyre::where('id',$id)->firstorfail()->delete();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' =>"Tyre deleted successfully",
        ],200);
    }

    public function search_filter(Request $request)
    {

        $keyword = $request->input('keyword');
        $query = Tyre::query();
        
        $test = array();
        
        if ($request->has('width'))
        {
            array_push($test, 'width');
                    
        }

        if ($request->has('height'))
        {
            array_push($test,'height');

        }

        
        if ($request->has('diameter'))
        {  
            array_push($test,'diameter');

        }

        if ($request->has('country_originals'))
        {
            array_push($test,'country_originals');

        }

        if ($request->has('speed_index'))
        {
            array_push($test,'speed_index');

        }

        if ($request->has('branch'))
        {
            array_push($test,'branch');

        }

        if ($request->has('brand'))
        {
            array_push($test,'brand');

        }

        if ($request->has('week'))
        {
            array_push($test,'week');

        }


        if ($request->has('year'))
        {
            array_push($test,'year');

        }
        
        foreach($test as $t)
        {
            if($t == 'width' || $t == 'height' || $t == 'diameter' || $t == 'year' || $t == 'week')
            {    
                $query->orWhere($t,$keyword);
            }
            else
            {
                $query->orWhere($t,'LIKE','%'.$keyword.'%');

            }
        }

        if(!$test)
        {
            $query->where(function ($query) use ($keyword)
            {
                 $query->Where('width',$keyword)
                  ->orWhere('height',$keyword)
                  ->orWhere('diameter',$keyword)
                  ->orWhere('country_originals','LIKE','%'.$keyword.'%')
                  ->orWhere('speed_index','LIKE','%'.$keyword.'%')
                  ->orWhere('branch','LIKE','%'.$keyword.'%')
                  ->orWhere('brand','LIKE','%'.$keyword.'%')
                  ->orWhere('week',$keyword)
                  ->orWhere('year',$keyword);
            });
        }
        $page_size=$request->page_size ?? 10 ;
        $count = $query->count();
        $tyres = $query->paginate($page_size);

        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' =>"Search result",
            'arr'=>$test,
            'total_amount'=>$count,
            'data'=>$tyres,
        ],200);
    }
}
