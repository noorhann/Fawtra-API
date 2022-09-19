<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Electronicinvoice;


use App\Http\Controllers\Controller;

class StatisticController extends Controller
{

    public function GetStatistic()
    {
        $Customers = Customer::where('branch_id',auth()->user()->branch_id)->count();
        $Invoices = Electronicinvoice::where(['branch_id' => auth()->user()->branch_id,'final' => 1,'deleted_at' => NULL])->count();
        $Jobs = Electronicinvoice::where([
            'branch_id' => auth()->user()->branch_id,
            'final' => 0,
            'deleted_at' => NULL
            ])->count();

        return response()->json([
            'status'=>true,
            'code'=>200,
            'Customers' =>  $Customers,
            'Invoices' =>  $Invoices,
            'Jobs' => $Jobs,
        ],200);

    }

}
