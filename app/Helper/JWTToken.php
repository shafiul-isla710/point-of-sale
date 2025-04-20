<?php

namespace App\Helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken{

     public static function createToken($userEmail,$userId= null){

           $key = env('JWT_key');
           $payload = [
               'iss' => "laravel-token",
               'iat' => time(),
               'exp' => time()+ 60*60,
               'email' => $userEmail,
               'id' => $userId
               
           ];

           return JWT::encode($payload, $key, 'HS256');
     }

     public static function createTokenForSetPassword($userEmail){

        $key = env('JWT_key');
        $payload = [
            'iss' => "laravel-token",
            'iat' => time(),
            'exp' => time()+ 60*60,
            'email' => $userEmail,
        ];

        return JWT::encode($payload, $key, 'HS256');
  }

     public static function verifyToken($token){

           try{
               if($token == null){
                   return "unauthorized";
               }
               else{
                 $key = env('JWT_key');
                 $decoded = JWT::decode($token,new Key($key,'HS256'));
                 return $decoded;
               }
           }
           catch (\Exception $e){
               return "unauthorized";
           }


     }
}