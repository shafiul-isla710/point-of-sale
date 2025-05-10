<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    
    public function createInvoice(Request $request){

        try{
            DB::beginTransaction();

            $userId = $request->header('id');
            $invoice =   Invoice::create([
                'total'=>$request->input('total'),
                'discount'=>$request->input('discount'),
                'vat'=>$request->input('vat'),
                'payable'=>$request->input('payable'),
                'user_id'=>$userId,
                'customer_id'=>$request->input('customer_id')
            ]);

            $invoice_id = $invoice->id;
            $products = $request->input('products');
            foreach($products as $eachProduct){
                InvoiceProduct::create([
                    'quantity'=>$eachProduct['quantity'],    
                    'sale_price'=>$eachProduct['sale_price'],
                    'user_id'=>$userId,
                    'invoice_id'=>$invoice_id,
                    'product_id'=>$eachProduct['product_id']
                ]);
            }
            DB::commit();
            return response()->json(['message'=>'Invoice Created Successfully','status'=>true]);
        }

        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>"Invoice Creation Failed",'status'=>false,'error'=> $e->getMessage()], 422);
        }
    }


    public function InvoiceList(Request $request){
        $userId = $request->header('id');
        $invoice = Invoice::with('customer')->where('user_id',$userId)->get();
        return response()->json(['invoice'=>$invoice],200);
    }

    public function InvoiceDetails(Request $request){

        $userId = $request->header('id');

        $customer = Customer::where('user_id',$userId)->where('id',$request->input('cust_id'))->first();
        $invoice = Invoice::with('customer','user')->where('user_id',$userId)->where('id',$request->input('inv_id'))->first();
        $invoiceProduct = InvoiceProduct::where('user_id',$userId)->where('invoice_id',$request->input('inv_id'))->first();

        return ['customer'=>$customer,'invoice'=>$invoice,'invoiceProduct'=>$invoiceProduct];
    }

    public function InvoiceDelete(Request $request){
        
        try{

            DB::beginTransaction();
            $userId = $request->header('id');
            InvoiceProduct::where('user_id',$userId)->where('invoice_id',$request->input('inv_id'))->delete();
            Invoice::where('user_id',$userId)->where('id',$request->input('inv_id'))->delete();
            DB::commit();
            return response()->json(['message'=>'Invoice Deleted Successfully','status'=>true]);
           

        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>"Invoice Deletion Failed",'status'=>false,'error'=> $e->getMessage()], 422);

        }
    }
  
    
}
