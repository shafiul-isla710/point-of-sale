<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;



class UserController extends Controller
{
    
    /**
     * pages
     */
  public function homePage(){
    return Inertia::render('homePage');
  }
    public function registrationPage(){
             return  Inertia::render('registrationPage');
    }
    public function loginPage(){
             return  Inertia::render('LoginPage');
    }
    public function sentOtp(){
        return  Inertia::render('SentOtpPage');
    }
    public function verifyOtpPage(){
        return  Inertia::render('VerifyOtpPage');
    }
   
    public function resetPasswordPage(){
        return  Inertia::render('ResetPassPage');
    }

       public function userRegistration(Request $request)
       {                 
               try {

               $validator = Validator::make($request->all(),[
                    'name'=>'required',
                    'email'=>'required|email|unique:users,email',
                    'mobile'=>'required',
                    'password'=>'required',
                    'image'=>'nullable'

                ]);

                if($validator->fails()){

                    // return response()->json(['message' => $validator->errors()], 422);
                    // return response()->json(['message'=>"User Registration Successfully",'status'=>true,'error'=> $validator->errors()], 422);
                    $data = ['message'=>"User Registration Failed",'status'=>false,'error'=> $validator->errors()];
                    return redirect('/registrationPage')->with($data);
                }
                $name = $request->input('name');
                $email = $request->input('email');
                 $mobile = $request->input('mobile');
                $password = $request->input('password');
                $profile_image = null;
                
                if($request->hasFile('image')){
                    $image = $request->file('image');
                    $imageName = 'profile_image'.time().".".$image->extension();
                    $image->storeAs('profile_images', $imageName, 'public');
                    $profile_image = 'storage/profile_images/'.$imageName;
                }
               

                // $image = $request->file('image');
                // $imageName = time().".".$image->getClientOriginalExtension();
                // $image->move(public_path('images'), $imageName);
            
               User::create([
                   'name' => $name,
                   'email' => $email,
                   'mobile' => $mobile,
                   'password' => $password,
                   'image'=>$profile_image,

               ]);

               $data = ['message'=>"User Registration Successfully",'status'=>true,'error'=>''];

                   return response()->json(['message'=>"User Registration Successfully",'status'=>true,'error'=>''], 200)->with($data);
                // return redirect('/registrationPage')->with($data);
                
              

                }

                catch (\Exception $e) {

                    $data = ['message'=>"User Registration Failed",'status'=>false,'error'=>$e->getMessage()];
                    // return redirect('/LoginPage')->with($data);

                    return response()->json(['message'=>"User Registration Failed",'status'=>false,'error'=>$e->getMessage()], 500);
                }
                
        }

       public function userLogin(Request $request) 
       {

            try{
                $name = $request->input('name');
                $email = $request->input('email');
                $password = $request->input('password');

                $id = User::where('email',$email)->orWhere('name',$name)->where('password',$password)->select('id')->first();
                // $count =  User::where('name',$name)->orWhere('email',$email)->where('password',$password)->count();
                $count = User::where('email',$email)->where('password',$password)->count();
                $user = User::where('email',$email)->first();

                if($count > 0){
    
                     $token = JWTToken::createToken($email,$id['id']);
    
                     return response()->json(['status'=>true,'message' => 'User logged in successfully!','token' => $token,'data' => $user], 200)->cookie('postoken',$token,60*24);
                }
                else{
                    return response()->json( ['status'=>false,'message' => 'Invalid credentials!'], 401);
                }
            }

            catch (\Exception $e) {
                return response()->json(['message' => 'User login failed!'], 500);
            }


       }

       public function updateUserData(Request $request){

           try{
            $request->validate([
                'name'=>'required',
                
                'mobile'=>'required',
                'password'=>'required',
                
            ]);
            User::where('id',$request->id)->update([
                 'name'=>$request->input('name'),
                 
                 'mobile'=>$request->input('mobile'),
                 'password'=>$request->input('password'),
            ]);
            return response()->json(['status'=>'success','message' => 'User data updated successfully!'], 200);
           }
              catch (\Exception $e) {
                return response()->json(['status'=>'failed','message' => 'Failed to update user data!'], 500);
              }
       }

       public function logout(Request $request){

          Cookie::queue(Cookie::forget('postoken'));
          return response()->json(['status'=>true,'message' => 'User logged out successfully!'], 200);
             

       }



       //If any user forgets his password, he can reset it by sending an OTP to his email.
       public function sentOpt(Request $request){
          
            try{
                $email = $request->input('email');

                $otp  = mt_rand(1000,9999);
   
                $count =  User::where('email',$email)->count();
   
                if($count > 0 ){
                    User::where('email',$email)->update(['otp' => $otp]);
             
                    Mail::to($email)->send(new OTPMail($otp));
                    $request->session()->put('email',$email);
                    return response()->json(['status'=>'success','message' => 'OTP sent successfully!',$otp], 200);
                }
                else{
                    return response()->json(['status'=>'failed', 'message' => 'Email not found!'], );
                }
            }
            catch (\Exception $e) {
                return response()->json(['status'=>'failed', 'message' => 'Failed to send OTP!'], 500);
            }

       }


       public function verifyOtp(Request $request){

             $email = $request->input('email');
             $otp = $request->input('otp');
            // $id = User::where('email',$email)->select('id')->first();
             $count =  User::where('email',$email)->where('otp',$otp)->count();

             if($count > 0){

                 User::where('email',$email)->update(['otp' => '0']);
                $token = JWTToken::createToken($email);
                 return response()->json(['status'=>'success','message' => 'OTP verified successfully!'], 200)->cookie('postoken',$token,60*24);

             }
             else{
                 return response()->json(['status'=>'failed','message' => 'Invalid OTP!']);
             }

       }


       public function resetPassword(Request $request){

            
             $email = $request->session()->get('email');
            
             User::where('email',$email)->update(['password' => $request->input('password')]);
             Cookie::queue(Cookie::forget('postoken'));
             return response()->json(['status'=>'success','message' => 'Password reset successfully!'], 200);
            
       }


       public function getUser(Request $request){

           $user = User::All();
           return response()->json(['user' => $user], 200);
       }
      
    
        
}