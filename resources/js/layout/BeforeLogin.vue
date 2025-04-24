


<template>

    <div class="bg-gray-100 font-sans max-h-screen ">
      <!-- Navbar -->
      <nav class="bg-white shadow p-4 flex justify-between items-center relative">
        <div class="flex flex-row gap-5" >
            <h1  @click="isOpen()" class="text-2xl font-bold text-gray-800 cursor-pointer ">{{ text }}</h1>
            <h1 class="text-xl font-bold text-gray-800 sm:hidden md:block">Inventory Dashboard</h1>
        </div>
        <div class="flex justify-end space-x-4 gap-5 mr-10">
          <!-- <button @click="profile = !profile" href="#" class="text-gray-700 hover:text-blue-600">Profile</button> -->
          <img @click="profile = !profile" class="h-8 w-8 rounded-full" v-if="user.image" :src="`${url}${user.image}`" alt="">
          
          <!-- <button @click="logout()" class="text-gray-700 hover:text-blue-600">Logout</button> -->
        </div>

        <div v-show="profile" class="absolute top-14 right-0 mt-3 mr-4 h-[230px] w-[200px] bg-white rounded-lg shadow-md p-4 ">
                
            <div class="flex flex-col items-center gap-3">
              <div class="h-12 w-12 rounded-full ring-2 ring-blue-400 mx-auto ">
                   <img class="h-12 w-12 rounded-full" v-if="user.image" :src="`${url}${user.image}`" alt="">
                </div>
                <h1 class="text-lg font-bold ">User Name :{{ user.name }}</h1>
            </div>
           
            <div class="flex flex-col gap-2 mt-2">
                <button class=" hover:border-b-2 border-indigo-500 p-2 hover:bg-red-50 text-left mt-2">Profile</button>
                <button @click="logout()" class=" hover:border-b-2 border-indigo-500 p-2 hover:bg-red-50 text-left">Logout</button>
            </div>
            
            </div>

           


      </nav>
    
      <div class="flex">
        <!-- Sidebar -->
        <aside  v-show="clicked"
         class="w-64 bg-white shadow h-screen p-5 hidden md:block transition-all duration-5000 ease-in-out transform"
         :class="{ '-translate-x-full': !clicked, 'translate-x-0': clicked }">
          <nav class="space-y-4">
            <a href="#" class="block text-gray-700 hover:text-blue-600">Dashboard</a>
            <a href="#" class="block text-gray-700 hover:text-blue-600">Products</a>
            <a href="#" class="block text-gray-700 hover:text-blue-600">Categories</a>
            <a href="#" class="block text-gray-700 hover:text-blue-600">Reports</a>
          </nav>
        </aside>
    
        <aside  v-show="!clicked"
         class="w-40 bg-white shadow h-screen p-5 hidden md:block transition-all duration-5000 ease-in-out transform"
         :class="{ '-translate-x-full': !clicked, 'translate-x-0': clicked }">
          <nav class="space-y-4">
            <a href="#" class="block text-gray-700 hover:text-blue-600">Dashboard</a>
            <a href="#" class="block text-gray-700 hover:text-blue-600">Products</a>
            <a href="#" class="block text-gray-700 hover:text-blue-600">Categories</a>
            <a href="#" class="block text-gray-700 hover:text-blue-600">Reports</a>
          </nav>
        </aside>
    
        <!-- Main Content -->
        <main class="flex-1 p-6">
          <h2 class="text-2xl font-semibold text-gray-700 mb-6">Overview</h2>
           
          <slot>
            
          </slot>
        
        </main>
      </div>
    </div>
    
    
    </template>
    
    <script setup>
    
    import { ref } from 'vue';
    import axios from 'axios';
    import { Link } from '@inertiajs/vue3';
    
    const clicked = ref(true);
    const profile = ref(false);
    const text = ref('closed');
    
    const isOpen = ()=>{
    
        clicked.value = !clicked.value;
        
        if(clicked.value == true){
            text.value = 'closed';
        }
        else{
            text.value = 'open';
        }
    }

   
     async function logout(){
    
         const response = await axios.get('/logout')
         if(response.status == 200){
           
           window.location.href = '/'
         }
         else{
            console.log('error')
         }
     }

      const userData = localStorage.getItem('user');
    const user = JSON.parse(userData);

    const url = 'http://127.0.0.1:8000/'

    console.log(user.image)
    
    
    </script>