
<template>

<main class="bg-white  max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl mt-20">
        <section>
            <h3 class="font-bold text-2xl">Welcome to Sent Oto page</h3>
            <p class="text-gray-600 pt-2">Sign in to your account.</p>
        </section>

        <section class="mt-10">
            <form @submit.prevent="onSubmit()" class="flex flex-col" >
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                    <input v-model="email"  type="text" id="email" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                </div>
                      
                <div class="flex gap-12">
                    <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 p-4 rounded shadow-lg hover:shadow-xl transition duration-200" type="submit">Sent OTP</button>
                    <Link  href="/LoginPage" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-lg hover:shadow-xl transition duration-200" type="submit">Cancel</Link>
                </div>

             <div class="max-w-lg mx-auto text-center mt-12 mb-6">
              <p class="text-black">Don't have an account? <Link href="/registrationPage" class="font-bold hover:underline">Sign up</Link>.</p>
        
         </div>

            </form>
        </section>
    </main>

</template>

<script setup>
import { Link,useForm,usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useToast } from 'vue-toast-notification';

import axios from 'axios';


const toast = useToast();

const email = ref('');

async function onSubmit(){
  
    if(!email.value){
            toast.error('Please enter your email address.',{
                position:'top-right',
            });
        }
        else{

            const response = await axios.post('/sent-opt', {
                email: email.value,
            });

            if(response.data.status=='success'){
                toast.success('Sent OTP Successfully',{
                    position:'top-right',
                    duration:3000,
                })
                setTimeout(()=>{
                    window.location.href = '/verifyOtpPage';
                },3000);
            }
            else{
                toast.error(response.data.message,{
                    position:'top-right',
                    duration:3000,
                })
            }
            // console.log(response.data.status)

        }

}



</script>