<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function CategoryPage(Request $request){

        $userId = $request->header('id');
        $categories = Category::where('user_id',$userId)->with('user')->get();

        return Inertia::render('CategoryPage',['list'=>$categories]);
    }
    public function categoryUpdatePage(Request $request){

        $id = $request->id;
      
        $categoryById = Category::where('id',$id)->first();
        return Inertia::render('CategoryUpdatePage',['category'=>$categoryById]);
    }
    

    public function createCategory(Request $request){

        try{
           $request->validate([
                'name'=>'required',
            ]);
           
            $userId = $request->header('id');
            Category::create([
                'name'=>$request->input('name'),
                'user_id'=>$userId
            ]);  
            $data = ['message'=>"Category Created Successfully",'status'=>true,'error'=>''];
            // return response()->json(['status'=>'success','message'=>'Category Created Successfully','id'=>$userId],200);
            return back()->with($data);
        }
        catch(\Exception $e){
            $data = ['message'=>"Category Creation Failed",'status'=>false,'error'=> $e->getMessage()];
            return redirect('/CategoryPage')->with($data);
            // return response()->json(['message'=>"Category Creation Failed",'status'=>false,'error'=> $e->getMessage()], 422);
        }
    }

    public function categoryList(Request $request){
        try{

            $userId = $request->header('id');
            $categories = Category::where('user_id',$userId)->with('user')->get();
            return response()->json(['categories'=>$categories],200);
            

        }
        catch(\Exception $e){
            return response()->json(['message'=>"Category List Retrieval Failed",'status'=>false,'error'=> $e->getMessage()], 422);
        }
    }

    public function updateCategoryName(Request $request){

        try{
            $categoryId = $request->id;
            $userId = $request->header('id');
            $categoryName = $request->input('name');
            $result = Category::where('id',$categoryId)->where('user_id',$userId)->update(['name'=>$categoryName]);
            if($result){
                $data = ['message'=>"Category Updated Successfully",'status'=>true,'error'=>''];
                return back()->with($data);
               
            }
            else{
                $data = ['message'=>"Somethings went wrong",'status'=>false,'error'=>''];
                return back()->with($data);
                
            }
        }
        catch(\Exception $e){
            $data = ['message'=>"Category Update Failed",'status'=>false,'error'=> $e->getMessage()];
            return back()->with($data);
            
        }
    }
    public function destroyCategory(Request $request){

        try{
            $categoryId = $request->id;
            $userId = $request->header('id');
            $result = Category::where('id',$categoryId)->where('user_id',$userId)->delete();
            if($result){
                $data = ['message'=>"Category Deleted Successfully",'status'=>true,'error'=>''];
                return back()->with($data);
                // return response()->json(['status'=>'success','message'=>'Category Deleted Successfully'],200);
            }
            else{
                $data = ['message'=>"Somethings went wrong",'status'=>false,'error'=>''];
                return back()->with($data);
                // return response()->json(['status'=>'failed','message'=>'Category Deletion Failed'],422);
            }
        }
        catch(\Exception $e){
            return response()->json(['message'=>"Category Deletion Failed",'status'=>false,'error'=> $e->getMessage()], 422);
        }
    }


}
