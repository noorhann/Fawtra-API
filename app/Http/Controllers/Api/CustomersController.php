<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Electronicinvoice;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{

    public function GetListCustomers(Request $request)
    {
        $page_size=$request->page_size ?? 10 ;
        $Customers = Customer::where('branch_id',auth()->user()->branch_id)->orderBy('id', 'desc')->paginate($page_size);
        
        return response()->json([
            'status'=>true,
            'code'=>200,
            'Customers' =>  $Customers,
        ],200);
    }

    public function ListCustomers(Request $request)
    {
        $Customers = Customer::where('branch_id',auth()->user()->branch_id)->orderBy('id', 'desc')->get();
        
        return response()->json([
            'status'=>true,
            'code'=>200,
            'Customers' =>  $Customers,
        ],200);
    }

    public function ShowCustomer(Request $request)
    {
        if(!empty($request->Customer_id)){
            $Customer = Customer::where('id',$request->Customer_id)->first();
            $Invoices = Electronicinvoice::where('customer_id',$request->Customer_id)->orderBy('id', 'desc')->get();
            $Cars     = Car::where('customer_id',$request->Customer_id)->orderBy('id', 'desc')->get();
    
            $this->data = [
                'value' => true,
                'data' => [
                        'Customer'  =>  $Customer,
                        'Car'       =>  $Cars,
                        'Invoice'   =>  $Invoices,
                ],
                        'code'      => 200,
            ];
    
            return response()->json($this->data, $this->data['code']);
        }else{
            return response()->json(['status'=>false,'message'=>'There is something wrong','code'=>400],400);
        }
        
    }

    public function AddCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[(a-zA-Z\s)\p{L}]+$/u|max:50',
            'mail' => 'nullable|email|unique:customers,mail',
            'phone' => 'required|min:9|max:9|digits:9|regex:/^[- +()]*[0-9][- +()0-9]*$/|unique:customers,phone',
            'address' => 'required', 
        
        ]);
        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,'message'=>$validator->errors(),'code'=>400],400);
        }
        $name = $request->name;
		$address = $request->address;
		$phone = $request->phone;
		$mail = $request->mail;
        
        if(!empty($mail))
		{
			$mail = $mail;
		}else{
			$mail = null;
		}

		$customer = new Customer;
		$customer->name = $name;
		$customer->phone = $phone;
		$customer->mail = $mail;
		$customer->address = $address;
		$customer->branch_id = Auth::user()->branch_id;

        $customer->save();

        return response()->json(['status'=>true,
                            'message'=>trans('customer created successfully'),
                            'code'=>201,
                            'data'=>$customer,
                        ],201);
    }

    public function updateCustomer($id,Request $request)
    {
        $customer = Customer::where('id',$id)->first();
        if (!$customer)
        {
            return response()->json(['status'=>false,
            'message'=>trans('User Not found '),
            'code'=>404,
            ],404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[(a-zA-Z\s)\p{L}]+$/u|max:50',
            //'mail' => 'required|email|unique:customers,mail',
            //'phone' => 'required|min:9|max:9|digits:9|regex:/^[- +()]*[0-9][- +()0-9]*$/|unique:customers,phone',
            'address' => 'required', 
            'phone' => ['required', 'min:9','max:9','regex:/^[- +()]*[0-9][- +()0-9]*$/' ,'unique:customers,phone,'.$customer->id],
            'mail' => ['nullable','string', 'email','unique:customers,mail,'.$customer->id],

        ]);
        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,'message'=>$validator->errors(),'code'=>400],400);
        }

        if(!empty($mail))
		{
			$mail = $mail;
		}else{
			$mail = null;
		} 
        
        $customer->name=$request->input('name');
        $customer->address=$request->input('address');
        $customer->mail=$request->input('mail');
        $customer->phone=$request->input('phone');

        $customer->save();
        return response()->json([
            'status'=>true,
            'message'=>'Customer data updated successfully',
            'code'=>200,
            'data'=>$customer,
        ],200);
    }

    public function delete($id)
    {
        $customer = Customer::where('id',$id)->firstorfail()->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Customer deleted successfully',
            'code'=>200,
        ],200);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $customer=Customer::where('branch_id',auth()->user()->branch_id)->where(function ($query) use($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
               ->orWhere('address', 'like', '%' . $keyword . '%')
               ->orWhere('phone', 'like', '%' . $keyword . '%')
               ->orWhere('id', 'like', '%' . $keyword . '%')
               ->orWhere('mail', 'like', '%' . $keyword . '%');

          })
            ->get();
        if (!$customer)
        {
            return response()->json(['status'=>false,
                'message'=>trans('No data found '),
                'code'=>404,
                ],404);
        }
            
        return response()->json([
                'status'=>true,
                'message'=>'search result',
                'code'=>200,
                'data'=>$customer,
            ],200);

    }

    public function customer_number()
    {
        $Customers = Customer::where('branch_id',auth()->user()->branch_id)->count();
        return response()->json([
            'status'=>true,
            'message'=>'number of customers retrived successfully',
            'code'=>200,
            'data'=>$Customers,
        ],200);
    }
    
}
