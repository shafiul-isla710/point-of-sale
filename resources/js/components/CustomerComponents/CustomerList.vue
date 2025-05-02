


<template>

<div class="max-w-7xl bg-white p-5 mx-auto ">

    <div class="sm:flex justify-between pb-3 items-center">
        <div>
            <span class="text-lg">Search Customer: </span>
            <input
                type="search"
                class="border border-gray-300 rounded-sm p-2 outline-none"
                placeholder="Search..."
                v-model="searchValue"
            />
        </div>

        <div>
           <button @click="showForm = true" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-sm transition hover:-translate-y-1 hover:scale-110 ease-in-out duration-200 delay-200">Create New</button>
        </div>

    </div>


    <EasyDataTable :headers="header" :items="item" :rows-per-page="5" alternating :search-value="searchValue" >

        <template #item-edit="{ id }">
            <Link class="py-2 px-3 text-sm bg-green-500 text-white rounded-sm mx-2" :href="`/customerEditPage?id=${id}`">Edit</Link>
           
        </template>

        <template #item-delete="{ id }">
            <button @click="deleteCategory(id)" class="py-2 px-3 bg-red-500 text-white rounded-sm mx-2 text-sm">Delete</button>
        </template>


    </EasyDataTable>


    <div class="fixed inset-0 sm:flex items-center justify-center bg-opacity-50 bg-black" v-show="showForm">
        <div class="bg-white p-4 rounded-lg w-1/2 mx-auto">
            <h2 class="text-xl font-bold mb-4">Create New Customer</h2>
            <form  @submit.prevent="onSubmit" class="mb-4">
                <div class="grid grid-cols-2 gap-4 mb-4">
                   <div >
                    <label for="customerName">Customer Name</label>
                    <input v-model="form.name" type="text" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
                   </div>
                   <div>
                    <label for="customerName">Customer Email</label>
                    <input v-model="form.email" type="email" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
                   </div>
                   <div>
                    <label for="customerName">Customer Mobile</label>
                    <input v-model="form.mobile" type="digits" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
                   </div>
                   <div>
                    <label for="customerName">Customer Address</label>
                    <input v-model="form.address" type="text" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
                   </div>
                </div>
                
                <!-- <input  type="email" placeholder="Customer Email" class="border border-gray-300 rounded-sm p-2 mb-4 w-full" />
                <input  type="text" placeholder="Customer Address" class="border border-gray-300 rounded-sm p-2 mb-4 w-full" />
                <input  type="text" placeholder="Customer Mobile" class="border border-gray-300 rounded-sm p-2 mb-4 w-full" /> -->
               <div class="flex justify-start gap-10 mt-4">
                    
                <button @click="showForm = false" type="button"  class="bg-red-500 text-white py-2 px-6 rounded-sm transition hover:-translate-y-0.5 hover:scale-110 duration-200 delay-150">Cancel</button>
                <button  type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-sm transition hover:-translate-y-0.5 hover:scale-110 duration-200 delay-150">Save</button>

               </div>
            </form>

        </div>

    </div>
   


</div>


</template>

<script setup>

import { ref } from 'vue';
import { usePage, Link,useForm,router } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';

const page = usePage();
const toast = useToast();

const searchValue = ref('');
const showForm = ref(false);


const item = page.props.customers

const header = ([
    {text:"No",value:"id"},
    {text:"Name",value:"name"},
    {text:"Email",value:"email"},
    {text:"Address",value:"address"},
    {text:"Mobile",value:"mobile"},
    {text:"Edit",value:"edit"},
    {text:"Delete",value:"delete"},
])

const form = useForm({
    name: "",
    email: "",
    address: "",
    mobile: "",
});

const onSubmit = ()=>{

    if(form.name == ""){
        toast.error("Please enter customer name",{
            position:"top-left",
            duration:1000,
        })
    }
    else if(form.email == ""){
        toast.error("Please enter customer email",{
            position:'top-left',
            duration:1000,
        })
    }
    else{

        form.post("/create-customer",{
        onSuccess:()=>{
            if(page.props.flash.status == true){
                toast.success(page.props.flash.message,{
                    position:"top-right",
                    duration:1000,
                })

                setTimeout(()=>{
                    router.get('/CustomerPage')
                },1000)
            }
            else{
                toast.error(page.props.flash.message,{
                    position:"top-left",
                    duration:1000,
                })
            }
        }

    })

    }

    

}

const deleteCategory = (id)=>{
    if(confirm("Are you Delete This Customer?")){
        router.delete(`/delete-customer/${id}`,{
            onSuccess:()=>{
                if(page.props.flash.status == true){
                    toast.success(page.props.flash.message,{
                        position:"top-right",
                        duration:1000,
                    })
                    setTimeout(()=>{
                        window.location.reload()
                    },1000)
                }
                else{
                    toast.error(page.props.flash.message,{
                        position:"top-left",
                        duration:1000,
                    })
                }
            }
        })
    }
}




</script>