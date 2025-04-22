


<template>

    <div class="bg-gray-100 font-sans max-h-screen ">
      <!-- Navbar -->
      <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div class="flex flex-row gap-5" >
            <h1  @click="isOpen()" class="text-2xl font-bold text-gray-800 cursor-pointer ">{{ text }}</h1>
            <h1 class="text-xl font-bold text-gray-800 sm:hidden md:block">Inventory Dashboard</h1>
        </div>
        <div class="flex justify-end space-x-4 gap-5 mr-10">
          <a href="#" class="text-gray-700 hover:text-blue-600">Profile</a>
          
          <button @click="logout()" class="text-gray-700 hover:text-blue-600">Logout</button>
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
    
    </script>