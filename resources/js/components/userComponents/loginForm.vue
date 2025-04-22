
<template>

<header class="max-w-lg mx-auto">
        <a href="#">
            <h1 class="text-4xl font-bold text-white text-center">Startup</h1>
        </a>
    </header>

    <main class="bg-white  max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl">
        <section>
            <h3 class="font-bold text-2xl">Welcome to Startup</h3>
            <p class="text-gray-600 pt-2">Sign in to your account.</p>
        </section>

        <section class="mt-10">
            <form @submit.prevent="onSubmit()" class="flex flex-col" >
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                    <input v-model="email" type="text" id="email" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                </div>
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                    <input v-model="password" type="password" id="password" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                </div>
                <div class="flex justify-end">
                    <Link href="/forgetPass" class="text-sm text-purple-600 hover:text-purple-700 hover:underline mb-6">Forgot your password?</Link>
                </div>
                <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200" type="submit">Sign In</button>
            </form>
        </section>
    </main>

    <div class="max-w-lg mx-auto text-center mt-12 mb-6">
        <p class="text-white">Don't have an account? <a href="#" class="font-bold hover:underline">Sign up</a>.</p>
    </div>

    

</template>

<script setup>


import { ref } from 'vue';
import axios from 'axios';
import {useToast} from 'vue-toast-notification';
import { Link } from '@inertiajs/vue3';

const toast = useToast();

const email = ref('');
const password = ref('');

const onSubmit = async () => {
    try {
       if(email.value == 0){
          toast.error('Email is required');
       }
       else if(password.value == 0){
          toast.error('Password is required');
       }
       else{
         const response = await axios.post('/login',{
            email: email.value,
            password: password.value
         })
         if(response.data['status'] == true && response.status == 200){
            toast.success('Login success',{
                position:'top-right',
                duration:2000,
            });

            setTimeout(()=>{
                window.location.href = '/dashboard';
            },2000);
         }
         
       }
    } catch (error) {
        if(error.response.status == 422){
            toast.error('Invalid credentials');
        }
        else if(error.response.status == 500){
            toast.error('Server error');
        }
        else if(error.response.status == 401){
            toast.error('Unauthorized access');
        }
        else{
            toast.error('Something went wrong');
        }
         // Handle error response
         // For example, show a toast notification or log the error
         // toast.error('An error occurred: ' + error.message);
        console.error(error);
    }
}


</script>