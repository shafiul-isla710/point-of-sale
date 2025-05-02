

<template>

  <div class="max-w-6xl mx-auto bg-white px-8 py-5 mt-10 rounded-md shadow-md">
    <h1 class="text-2xl ">Update Customer Information</h1>

    <form @submit.prevent="updateCustomer" class="mb-4">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="customerName">Customer Name</label>
                <input v-model="form.name" type="text" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
            </div>
            <div>
                <label for="customerName">Customer Email</label>
                <input v-model="form.email" type="email" readonly placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
            </div>
            <div>
                <label for="customerName">Customer Mobile</label>
                <input v-model="form.mobile" type="text" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
            </div>
            <div>
                <label for="customerName">Customer Address</label>
                <input v-model="form.address" type="text" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
            </div>
        </div>

        <div class="flex justify-start gap-10 mt-4">
            <Link class="bg-red-500 text-white py-2 px-6 rounded-sm transition hover:-translate-y-0.5 hover:scale-110 duration-200 delay-150" href="/CustomerPage">Cancel</Link>
            <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-sm transition hover:-translate-y-0.5 hover:scale-110 duration-200 delay-150">Update</button>
        </div>
    </form>

  </div>

</template>

<script setup>

import { usePage, Link, useForm, router } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToast } from "vue-toast-notification";

const page = usePage();
const toast = useToast();

const customer = page.props.customer;
const form = useForm({
    name: customer.name,
    email: customer.email,
    mobile: customer.mobile,
    address: customer.address,
});

const param = new URLSearchParams(window.location.search);
const id = param.get('id');

const updateCustomer = ()=>{
    form.put(`/update-customer/${id}`,{
        onSuccess:()=>{
            if(page.props.flash.status == true){
                toast.success(page.props.flash.message,{
                    position:'top-right',
                    duration:2000,
                })
                setTimeout(()=>{
                    router.get('/CustomerPage')
                },2000,)
            }
            else{
                toast.error(page.props.flash.message,{
                    position:'top-left',
                    duration:2000,
                })
            }
        }
    })
}


</script>
