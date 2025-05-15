


<template>

    <div class="bg-gray-100 font-sans h-[100vh]">
      <!-- Navbar -->
      <nav class="bg-white shadow p-4 flex justify-between items-center sticky top-0 z-10 ">
        <div class="flex flex-row gap-5" >
            <h1  @click="isOpen()" class="text-2xl font-bold text-gray-800 cursor-pointer ">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
        </svg>
            </h1>
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
                <h1 class="text-sm font-bold ">User Name :{{ user.name }}</h1>
            </div>
           
            <div class="flex flex-col gap-2 mt-2">
                <Link href="/ProfilePage" class=" hover:border-b-2 border-indigo-500 p-2 hover:bg-red-50 text-left mt-2">Profile</Link>
                <button @click="logout()" class=" hover:border-b-2 border-indigo-500 p-2 hover:bg-red-50 text-left">Logout</button>
            </div>
            
            </div>

           


      </nav>
    
      <div class="flex ">
        <!-- Sidebar -->
        <aside  v-show="clicked"
         class="w-64 bg-gray-700 text-white  shadow h-screen  hidden md:block transition-all duration-5000 ease-in-out transform"
         :class="{ '-translate-x-full': !clicked, 'translate-x-0': clicked }">
          <nav class="space-y-4 mt-5">
            <div class="dbtn "> 
              <Link href="/dashboard" class="block  ml-5 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 inline-block" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
          <path strokeLinecap="round" strokeLinejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
          </svg>
                Dashboard</Link>
            </div>
            <div class="dbtn"> 
              <Link href="/CategoryPage" class="block  ml-5 py-3">
                 <svg xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 inline-block">
           <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
            </svg>
                Category</Link>
            </div>
            <div class="dbtn"> 
              <Link href="/CustomerPage" class="block  ml-5 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 inline-block">
             <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
             </svg>
                Customer</Link>
            </div>
            <div class="dbtn"> 
              <Link href="/invoice-page" class="block ml-5 py-3">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 inline-block">
             <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
                Create sale</Link>
            </div>
            <div class="dbtn"> 
              <Link href="/product-page" class="block ml-5 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 inline-block">
             <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
            </svg>
                Product</Link>
            </div>
          </nav>
        </aside>
    
        <aside  v-if="!clicked"
         class="w-40 bg-black shadow h-screen p-5 hidden md:block transition-all duration-5000 ease-in-out transform"
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

   
    
    
    </script>