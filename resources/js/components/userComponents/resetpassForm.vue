

<template>

        <!-- component -->
 <!-- <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
<div class="">
    <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
        <h1 class="text-4xl font-medium">Reset password</h1>
        <p class="text-slate-500">Fill up the form to reset the password</p>

        <form action="" class="my-10">
            <div class="flex flex-col space-y-5">
                <label for="email">
                    <p class="font-medium text-slate-700 pb-2">Set New Password</p>
                    <input id="email" name="email" type="email" class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow" placeholder="Enter Password">
                </label>
                <label for="email">
                    <p class="font-medium text-slate-700 pb-2">Confirm Password</p>
                    <input id="email" name="email" type="email" class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow" placeholder="Confirm Password">
                </label>
               
                <Link href="/LoginPage" class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">Next</Link>
               
                <p class="text-center">Not registered yet? <a href="#" class="text-indigo-600 font-medium inline-flex space-x-1 items-center"><span>Register now </span><span><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                  </svg></span></a></p>
            </div>
        </form>
    </div>
</div>
    
</div> -->

<div class="bg-white  max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl mt-20">
        <div class="">
            <h1 class="text-4xl font-medium">Reset password</h1>
        <p class="text-slate-500">Fill up the form to reset the password</p>
            <form  @submit.prevent="onSubmit()" class="space-y-4">
                <div>
                 
                    <label
                        for="otp"
                        class="block text-sm font-medium text-gray-700"
                        >Enter New Password</label
                    >
                    <input
                        type="text"
                        id="otp"
                        name="otp"
                    
                        placeholder="Password"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        v-model="otp"
                    />
                </div>
               <button type="submit"  class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">Confirm</button>
            </form>
            <div class="text-center mt-4">
                <p class="text-gray-600 text-sm">
                    Didn't receive the OTP?
                    <a href="#" class="text-blue-600 hover:underline"
                        >Resend OTP</a
                    >
                </p>
            </div>
        </div>
    </div>



</template>

<script setup>

import { ref } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toast-notification';

const toast = useToast();
const password = ref();

const onSubmit = ()=>{

    if(!password.value){
        toast.error('Please enter your password', {
            position: 'top-right',
            duration: 3000,
            dismissible: true,
        });
    }
    else{
        axios.post('/')

    }
}






</script>
