<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
    /**
     * Create Customer
     */
    public function createCustomer(Request $request){

      try{

        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|max:255|unique:customers',
            'mobile'=>'nullable|max:13|min:10',
            'address'=>'nullable|max:255',
        ]);

        $userId = $request->header('id');
        Customer::create($request->input() + ['user_id'=>$userId]);

        // $data = ['message'=>'Customer Created Successfully','status'=>true,'error'=>''];
        // return redirect()->back()->with($data);
        return response()->json([
            'message'=>'Customer Created Successfully',
            'status'=>true,
            'error'=>''
        ], 200);

      }

      catch(\Exception $e){
        return response()->json([
            'message'=>'Customer Creation Failed',
            'status'=>false,
            'error'=>$e->getMessage()
        ]);

      }

    }

    /**
     * Get Customer
     */
    public function getCustomer(Request $request){
        $id =$request->id;
        $userId = $request->header('id');
        $customer = Customer::with('user')->findOrFail($id)->where('user_id',$userId)->first();
       
        if($customer){
            return response()->json([
                'message'=>'Customer Found',
                'status'=>true,
                'error'=>'',
                'customer'=>$customer
            ], 200);
        }
        else{
            return response()->json([
                'message'=>'Customer Not Found',
                'status'=>false,
                'error'=>''
            ]);
        }
    }
    /**
     * Update Customer
     */
    public function updateCustomer(Request $request){
      try{
          $request->validate([
            'name'=>'required|max:255',
            'mobile'=>'nullable|max:13|min:10',
            'address'=>'nullable|max:255',
          ]);
          $userId = $request->header('id');
          $customerId = $request->id;
         $result = Customer::findOrFail($customerId)->where('user_id',$userId)->update([
            'name'=>$request->input('name'),
            'mobile'=>$request->input('mobile'),
            'address'=>$request->input('address')
          ]);

          if($result){
            return response()->json([
              'message'=>'Customer Updated Successfully',
              'status'=>true,
              'error'=>''
          ], 200);
          }
          else{
            return response()->json([
              'message'=>'Somethings went wrong',
              'status'=>false,
              'error'=>''
          ]);
          }

         
      }
      catch(\Exception $e){
          return response()->json([
              'message'=>'Customer Update Failed',
              'status'=>false,
              'error'=>$e->getMessage()
          ]);
      }

    }

    /**
     * Delete Customer
     */
    public function deleteCustomer(Request $request){
        $customerId = $request->id;
        $userId = $request->header('id');
        $result = Customer::where('id',$customerId)->where('user_id',$userId)->delete();
        if($result){
            return response()->json([
                'message'=>'Customer Deleted Successfully',
                'status'=>true,
                'error'=>''
            ], 200);
        }
        else{
            return response()->json([
                'message'=>'Somethings went wrong',
                'status'=>false,
                'error'=>''
            ]);
        }
    }

}
