<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    
    /**
     * render view
     */
    public function customerPage(Request $request){
        $userId = $request->header('id');
        $customers = Customer::where('user_id',$userId)->get();
        return Inertia::render('CustomerPage',[
            'customers'=>$customers,
        ]);

    }

    public function customerEditPage(Request $request){
        $id = $request->id;
        $userId = $request->header('id');
        $customer = Customer::where('user_id',$userId)->where('id',$id)->first();
        return Inertia::render('CustomerEditPage',[
            'customer'=>$customer,
        ]);
    }

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

        $data = ['message'=>'Customer Created Successfully','status'=>true,'error'=>''];
        return redirect()->back()->with($data);
       

      }

      catch(\Exception $e){
    
        $data = ['message'=>'Customer Creation Failed','status'=>false,'error'=>''];
        return redirect()->back()->with($data);
      }

    }

    /**
     * Get Customer
     */
    public function customerById(Request $request){
        $id =$request->id;
        $userId = $request->header('id');
        $customer = Customer::with('user')->where('id',$id)->where('user_id',$userId)->first();
       
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
             $data= ['message'=>'Customer Updated Successfully','status'=>true,'error'=>''];
             return redirect()->back()->with($data);
          }
          else{
             $data= ['message'=>'Customer Not Found','status'=>false,'error'=>''];
             return redirect()->back()->with($data);
          }

         
      }
      catch(\Exception $e){
        $data= ['message'=>'Customer Update Failed','status'=>false,'error'=>''];
        return redirect()->back()->with($data);
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

             $data = ['message'=>'Customer Deleted Successfully','status'=>true,'error'=>''];
             return redirect()->back()->with($data);
           
        }
        else{
            $data = ['message'=>'Somethings went wrong','status'=>false,'error'=>''];
            return redirect()->back()->with($data);
        }
    }

}
