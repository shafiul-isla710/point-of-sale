
<template>


<div class=" h-[800px] md:max-w-6xl mx-auto mt-6 md:h-[500px] rounded-sm p-5">

  <div class="sm:w-[400px] md:w-full mx-auto lg:max-w-4xl bg-white shadow-lg rounded-lg p-6 absolute">
      <form action="" @submit.prevent="updateProfile">
        <div class="card-body">
      <h4 class="text-2xl font-semibold mb-4">Update Your Information</h4>
      <hr class="mb-6"/>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="p-2">
          <label class="block text-gray-700 font-medium mb-2">Name</label>
          <input v-model="form.name" id="Name" placeholder="Name" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none" type="text"/>
        </div>
        <div class="p-2">
          <label class="block text-gray-700 font-medium mb-2">Email Address</label>
          <input v-model="form.email"  id="email" placeholder="User Email" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none" type="email" readonly />
        </div>
       
        
        <div class="p-2">
          <label class="block text-gray-700 font-medium mb-2">Mobile Number</label>
          <input  v-model="form.mobile" id="mobile" placeholder="Mobile" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none" type="text"/>
        </div>
        <div class="p-2">
          <label class="block text-gray-700 font-medium mb-2">Password</label>
          <input v-model="form.password"  id="password" placeholder="User Password" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none" type="password"/>
        </div>
      </div>
      
        <div class="w-1/2 flex flex-row gap-5  mt-4">
            <Link href="/dashboard" class="w-2/4 mx-auto  py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">Back</Link>
            <button type="submit"  class="w-2/4 mx-auto py-3 font-medium text-white bg-yellow-600 hover:bg-yellow-500 rounded-lg border-yellow-500 hover:shadow inline-flex space-x-2 items-center justify-center">Update Profile Info</button>
        </div>
    </div>

      </form>
  </div>
</div>
</template>

<script setup>

import { ref, onMounted } from 'vue';
import axios from 'axios';
import { Link } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';


  const toast = useToast();
  const userData = localStorage.getItem('user');
  const loggedUser  = JSON.parse(userData);

  const form = ref({
    name: loggedUser.name,
    email: loggedUser.email,
    mobile: loggedUser.mobile,
    password: loggedUser.password,
  })

  console.log(loggedUser.password)

  const updateProfile = async()=>{
      try{

        const response = await axios.put('/update-user/'+loggedUser.id,form.value)

        if(response.data.status == 'success'){
          toast.success('Profile updated successfully',{
            position:'top-right',
            duration:1000,
          })
          setTimeout(() => {
            window.location.href = '/LoginPage'
          }, 1000);
        }
        else {
          toast.error('Profile update failed',{
            position:'top-right',
            duration:1000,
          })
        }
      }
      catch(error){
        console.log(error)
      }
  }

</script>