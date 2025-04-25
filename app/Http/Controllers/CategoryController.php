<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    

    public function createCategory(Request $request){

        try{
           

            $userId = $request->header('id');
            Category::create([
                'name'=>$request->name,
                'user_id'=>$userId
            ]);  
            return response()->json(['status'=>'success','message'=>'Category Created Successfully','id'=>$userId],200);
        }
        catch(\Exception $e){
            return response()->json(['message'=>"Category Creation Failed",'status'=>false,'error'=> $e->getMessage()], 422);
        }
    }

    public function categoryList(Request $request){
        try{

            $userId = $request->header('id');
            $categories = Category::where('user_id',$userId)->get();
            return response()->json(['status'=>'success','message'=>'Category List Retrieved Successfully','data'=>$categories],200);
            

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
                return response()->json(['status'=>'success','message'=>'Category Updated Successfully'],200);
            }
            else{
                return response()->json(['status'=>'failed','message'=>'Category Update Failed'],422);
            }
        }
        catch(\Exception $e){
            return response()->json(['message'=>"Category Update Failed",'status'=>false,'error'=> $e->getMessage()], 422);
        }
    }
    public function destroyCategory(Request $request){

        try{
            $categoryId = $request->id;
            $userId = $request->header('id');
            $result = Category::where('id',$categoryId)->where('user_id',$userId)->delete();
            if($result){
                return response()->json(['status'=>'success','message'=>'Category Deleted Successfully'],200);
            }
            else{
                return response()->json(['status'=>'failed','message'=>'Category Deletion Failed'],422);
            }
        }
        catch(\Exception $e){
            return response()->json(['message'=>"Category Deletion Failed",'status'=>false,'error'=> $e->getMessage()], 422);
        }
    }


}
