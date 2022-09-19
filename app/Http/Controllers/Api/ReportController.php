<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Electronicinvoice;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{

    public function total_reports(Request $request)
    {
        $Total_Invoices = Electronicinvoice::where(['branch_id' => auth()->user()->branch_id,'final' => 1,'deleted_at' => NULL])->count();
       
        $page_size = $request->page_size ?? 10 ;

        $invoices=Electronicinvoice::where('branch_id',auth()->user()->branch_id)->where('final',1)->whereNull('deleted_at')->orderBy('id','DESC')->paginate($page_size);
        $total_amounts =Electronicinvoice::select(DB::raw('SUM(paid_amount) as total_paid_amount'))->where('branch_id',auth()->user()->branch_id)->where('final',1)->whereNull('deleted_at')->get();   
        $total_amounts_without_tax =Electronicinvoice::select(DB::raw('SUM(total_amount) as total_without_tax_amount'))->where('branch_id',auth()->user()->branch_id)->where('final',1)->whereNull('deleted_at')->get();   

        return response()->json([
            'status'=>true,
            'code'=>200,
            'Total_Invoices' =>  $Total_Invoices,
            'total_amount' =>$total_amounts,
            'total_without_tax' =>$total_amounts_without_tax,

            'data'=>$invoices,
        ],200);

    }

    public function total_filter_date(Request $request)
    {
        //$start = Carbon::parse($request->start_date)->toDateTimeString();

        //$end = Carbon::parse($request->end_date)->toDateTimeString();

        $start =  Carbon::parse($request->start_date)->startOfDay()->format('Y-m-d H:i:s');
        $end = Carbon::parse($request->end_date)->endOfDay()->format('Y-m-d H:i:s');

        $Total_Invoices = Electronicinvoice::where(['branch_id' => auth()->user()->branch_id,'final' => 1,'deleted_at' => NULL])->whereBetween('created_at', [$start, $end])->count();
        $page_size = $request->page_size ?? 10 ;

        $invoices=Electronicinvoice::where('branch_id',auth()->user()->branch_id)->where('final',1)->whereNull('deleted_at')->whereBetween('created_at', [$start, $end])->orderBy('id','DESC')->paginate($page_size);
        $total_amounts =Electronicinvoice::select(DB::raw('SUM(paid_amount) as total_paid_amount'))->where('branch_id',auth()->user()->branch_id)->where('final',1)->whereNull('deleted_at')->whereBetween('created_at', [$start, $end])->get();   
        $total_amounts_without_tax =Electronicinvoice::select(DB::raw('SUM(total_amount) as total_without_tax_amount'))->where('branch_id',auth()->user()->branch_id)->where('final',1)->whereNull('deleted_at')->whereBetween('created_at', [$start, $end])->get();   

        return response()->json([
            'status'=>true,
            'message'=>'filter result',
            'code'=>200,
            'Total_Invoices'=> $Total_Invoices,
            'total_amount' =>$total_amounts,
            'total_without_tax' =>$total_amounts_without_tax,
            'data'=>$invoices,
         ],200);
    }
}
