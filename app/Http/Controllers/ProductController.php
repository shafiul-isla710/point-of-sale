<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

use function PHPUnit\Framework\fileExists;

class ProductController extends Controller
{

    //page render
    public function ProductPage(Request $request)
    {

        $userId = $request->header('id');
        $products = Product::with('category')->where('user_id', $userId)->paginate(5);
        return Inertia::render('ProductPage', ['products' => $products]);
    }

    public function ProductEditPage(Request $request)
    {

        $id = $request->id;
        $product = Product::where('id', $id)->first();
        return Inertia::render('ProductEditPage', ['product' => $product]);
    }

    public function getAllProduct(Request $request)
    {

        $userId = $request->header('id');
        $products = Product::with('category')->where('user_id', $userId)->get();
        return response()->json([
            'status' => true,
            'message' => 'Products retrieved successfully',
            'data' => $products
        ]);
    }

    public function createProduct(Request $request)
    {
        try {

            $userId = $request->header('id');
            $request->validate([
                'name' => 'required',
                'description' => 'nullable',
                'price' => 'required|numeric',
                'category_id' => 'required',
                'image' => 'required',
            ]);

            $img = $request->file('image');
            $t = time();
            $fileName = $img->getClientOriginalName();
            $imageName = "{$userId}-{$t}-{$fileName}";
            $img_url = "product_images/{$imageName}";

            $img->move(public_path('product_images'), $imageName);

            $result =  Product::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'image' => $img_url,
                'user_id' => $userId,
                'category_id' => $request->input('category_id')
            ]);

            if ($result) {
                $data = ['message' => "Product Created Successfully", 'status' => true, 'error' => ''];
                return redirect()->back()->with($data);
            }
        } catch (\Exception $e) {

            $data = ['message' => "Product Created Successfully", 'status' => false, 'error' => $e->getMessage()];
            return redirect()->back()->with($data);
        }
    }

    public function destroyProduct(Request $request)
    {


        try {

            $userId = $request->header('id');
            $id = $request->id;
            $productInfo = Product::where('id', $id)->first();
            $file_path = $productInfo->image;
            File::delete($file_path);
            Product::where('user_id', $userId)->where('id', $id)->delete();

            // return response()->json(['delete'=>'success']);

            $data = ['message' => "Product Deleted Successfully", 'status' => true, 'error' => ''];
            return redirect()->back()->with($data);
        } catch (\Exception $e) {
            $data = ['message' => "Product Deletion Failed", 'status' => false, 'error' => $e->getMessage()];
            return redirect()->back()->with($data);
        }
    }

   
    public function updateProduct(Request $request)
    {

        try {
            $user_id = $request->header('id');
            $product_id = $request->id;



            if ($request->hasFile('image')) {

                $img = $request->file('image');
                $t = time();
                $fileName = $img->getClientOriginalName();
                $imgName = "{$user_id}-{$t}-{$fileName}";
                $img_url = "product_images/{$imgName}";
                $img->move(public_path('product_images'), $imgName);
                $productInfo = Product::where('user_id', $user_id)->where('id', $product_id)->first();
                $image_path = $productInfo->image;
                File::delete($image_path);

                Product::where('user_id', $user_id)->where('id', $product_id)->update([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'image' => $img_url,
                    'category_id' => $request->input('category_id')
                ]);

                $data = ['message' => 'Product updated successfully', 'status' => true, 'error' => ''];
                return redirect()->back()->with($data);
                // return response()->json(['status'=>true,'message'=>'Product updated successfully']);

            } else {

                Product::where('user_id', $user_id)->where('id', $product_id)->update([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'category_id' => $request->input('category_id')
                ]);


                $data = ['message' => 'Product updated successfully', 'status' => true, 'error' => ''];
                return redirect()->back()->with($data);
                // return response()->json(['status'=>true,'message'=>'Product updated successfully']);
            }
        } catch (\Exception $e) {
            $data = ['message' => 'Product updation failed', 'status' => false, 'error' => $e->getMessage()];
            return redirect()->back()->with($data);
            // return response()->json(['status'=>false,'message'=>'Product updation failed','error'=>$e->getMessage()]);
        }
    }


     public function productById(Request $request)
    {
        try {
            $userId = $request->header('id');
            $product_id = $request->id;
            $product = Product::where('user_id', $userId)->where('id', $product_id)->first();
            return response()->json(['status' => true, 'message' => 'Product retrieved successfully', 'data' => $product]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Product retrieval failed', 'error' => $e->getMessage()]);
        }
    }
}
