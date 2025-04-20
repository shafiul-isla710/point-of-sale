
<template>

<div class="bg-white  max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl mt-20">
        <div class="">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">
                Verify Your OTP
            </h2>
            <p class="text-gray-600 text-center mb-6">
                We have sent a One-Time Password (OTP) to your registered email
                or phone number.
            </p>
            <form  @submit.prevent="onSubmit()" class="space-y-4">
                <div>
                    <label
                        for="otp"
                        class="block text-sm font-medium text-gray-700"
                        >Enter Email</label
                    >
                    <input
                        type="email"
                        id="otp"
                        name="otp"
                        
                        placeholder="Enter your email"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                      v-model="email"
                    />

                    <label
                        for="otp"
                        class="block text-sm font-medium text-gray-700"
                        >Enter OTP</label
                    >
                    <input
                        type="text"
                        id="otp"
                        name="otp"
                        maxlength="6"
                        placeholder="6-digit OTP"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        v-model="otp"
                    />
                </div>
               <button type="submit"  class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">Verify OTP</button>
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

import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toast-notification';

const toast = useToast();
const email = ref('');
const otp = ref('');

const onSubmit = async()=>{
   
    if(!email.value){

        toast.error('Please enter your email address.',{
            position:'top-right',
            duration:2000,
        });
    }
    else if(!otp.value){

        toast.error('Please enter your OTP.',{
            position:'top-right',
            duration:2000,
        });
    }
    else{
        const response = await axios.post('/verify-otp',{
            email: email.value,
            otp: otp.value,
        })

        if(response.data.status == 'success'){
            toast.success('OTP verified successfully.',{
                position:'top-right',
                duration:2000,
            })

            setTimeout(() => {
                window.location.href = '/resetPassword';
            }, 2000);
         }
         else{
            toast.error('Invalid OTP. Please try again.',{
                position:'top-right',
                duration:2000,
            })
         }
     }

}



</script>
