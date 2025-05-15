
<template>
    <div class="container mx-auto bg-[#f1f1f1] h-screen sm:h-[800px]">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 h-[600px]">
            <div id="first card" class="bg-white py-10 px-7 shadow-md rounded-md">
                <div id="head" class="sm:flex justify-between items-center">
                    <div >
                        <h1 class="text-xl mb-2 font-semibold">BILLED TO</h1>
                        <p>Name: {{ customer.name }}</p>
                        <p>Email: {{ customer.email }}</p>
                        <p>Mobile: {{ customer.mobile }}</p>
                    </div>
                    <div>
                        <h1 class="md:text-2xl lg:text-3xl font-bold">Shop</h1>
                        <p>Invoice</p>
                        <p>Current Date :</p>
                    </div>
                </div>

                <hr class="my-4" />

                <div id="table">
                    <table class="w-full mt-5 auto-table text-sm md:text-base">
                        <thead class="text-left">
                            <tr >
                                <th class="">Name</th>
                                <th class="">Quantity</th>
                                <th class="">Total</th>
                                <th class="">Remove</th>
                            </tr>
                        </thead>
                        <tbody class="text-left ">
                            <tr class=" border border-b-4 border-gray-50 hover:bg-gray-200 p-4">
                                <td class="p-4 text-left">Milks & Drinks</td>
                                <td class="p-4 text-left">4</td>
                                <td class="p-4 text-left">৳ 32,000</td>
                                <td class="p-4 text-left">
                             <svg xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                           <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                           </svg>
    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr class="my-4" />

                <div>
                    <div>
                         <h1>Total: NoN</h1>
                         <h1>Payable: NoN</h1>
                         <h1>Vat(%): NoN</h1>
                         <h1>Discount: NoN</h1>
                    </div>
                     <div class="flex gap-2 flex-col w-1/2">
                         <h1>Discount(%)</h1>
                         <input  class="p-2 outline-none rounded-md border-2 border-gray-200" type="number">
                         <button class="bg-indigo-500 px-3 py-2 rounded-md text-white">Confirm</button>
                     </div>
                </div>
            </div>

            <div id="second card" class="bg-white py-10 px-7 shadow-md rounded-md">

                 <div class="grid grid-cols-4">
                      <div  class="col-span-3 col-start-2 flex flex-row gap-3 ">
                        <p>Search</p>
                        <input  class="p-1 w-full outline-none rounded-lg border-2 border-gray-200" type="text">
                      </div>
                      <div class="col-span-4">
                        <h1>Product</h1>
                          <table class="w-full mt-5 auto-table text-sm md:text-base">
                        <thead class="text-left">
                            <tr >
                                <th class="">Product Name</th>
                                <th class="">Details</th>
                                <th class="">Pick</th>
                            </tr>
                        </thead>
                        <tbody class="text-left ">
                            <tr v-for="(product,index) in products.data" :key="index"  class=" border border-b-4 border-gray-50 hover:bg-gray-200">
                                <td class="p-4 text-left w-52" >{{product.name}}</td>
                                <!-- <td  @click="productDetails(product.id)" class="p-2 text-left cursor-pointer w-16">View
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </td> -->
                                <td><button @click="productDetails(product.id)" class="bg-blue-400 text-white px-5 py-1 rounded-sm ">
                                   view

                                </button></td>
                              <td><button @click="addProduct(product.id)" class="bg-green-400 hover:bg-green-500 px-5 py-1 text-white transition rounded-sm">Add</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex gap-2 mt-10">
                        <button @click="previous" class="border border-green-300 hover:border-green-700 rounded-md py-1 px-6 transition ease-in-out duration-300 hover:bg-red-100">Previous</button>
                          <button >{{ products.current_page }}</button>
                        <button @click="next" class="border border-green-300 hover:border-green-700 rounded-md py-1 px-6 transition ease-in-out duration-300 hover:bg-red-100">Next</button>
                    </div>

                      </div>
                 </div>

            <div v-show="showProduct" v-if="selectProduct" class="fixed top-1/4 mx-auto h-[300px] w-[350px] bg-gray-100 p-5 shadow-orange-200 rounded-md ">

                <svg @click="showProduct = false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9 text-red-500 ">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
              
                  <img  class="w-3/5 mx-auto h-[100px]" :src="selectProduct.image" alt="">
                
                <hr class="my-4">
                <h1 class="text-xl font-semibold ">Product Name : {{ selectProduct.name }}</h1>
                <p class="mb-2 mt-2">Description : {{ selectProduct.description }}</p>
                <h1>Price : {{ selectProduct.price }}</h1>
                

            </div>

             <div v-show="showAddProduct" class="fixed inset-0 sm:flex items-center justify-center bg-opacity-50 bg-black" >
        <div class="bg-white p-4 rounded-lg w-2/6 mx-auto">
            <h2 class="text-xl font-bold mb-4">ADD PRODUCTS</h2>
            <hr class="mt-10 mb-3">
            <form   class="mb-4 p-10">
                <div class="grid grid-cols-1 gap-4 mb-4">
                   <div >
                    <label for="customerName">Product Id</label>
                    <input v-model="product.id"  type="text" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
                   </div>
                   <div>
                    <label for="customerName">Product Name</label>
                    <input v-model="product.name"  type="email" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
                   </div>
                   <div>
                    <label for="customerName">Price</label>
                    <input v-model="product.price"  type="digits" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
                   </div>
                   <div>
                    <label for="customerName">Quantity</label>
                    <input v-model="product.quantity"  type="number" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
                   </div>
                </div>
                
               <div class="flex justify-start gap-10 mt-4">
                    
                <button @click="showAddProduct = false"   type="button"  class="bg-red-500 text-white py-2 px-6 rounded-sm transition hover:-translate-y-0.5 hover:scale-110 duration-200 delay-150">Cancel</button>
                <button  type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-sm transition hover:-translate-y-0.5 hover:scale-110 duration-200 delay-150">Save</button>

               </div>
            </form>

        </div>

    </div>

           
                
            </div>


            <div id="third card" class="bg-white py-10 px-7 shadow-md rounded-md">
                  <div class="grid grid-cols-4">
                      <div  class="col-span-3 col-start-2 flex flex-row gap-3 ">
                        <p>Search</p>
                        <input  class="p-1 w-full outline-none rounded-lg border-2 border-gray-200" type="text">
                      </div>
                      <div class="col-span-4">
                        <h1>Customer</h1>

                          <table class="w-full mt-5 auto-table text-sm md:text-base">
                        <thead class="text-left">
                            <tr >
                                <th class="p-4 text-left w-52">Name</th>
                                <th class="p-4 text-left w-52">Email</th>
                                <th class="p-4 text-left w-52">Id</th>
                                <th class="p-4 text-left w-52">Pick</th>
                                
                            </tr>
                        </thead>
                        <tbody class="text-left ">
                            <tr v-for="(customer,index) in customers.data" :key="index" class=" border border-b-4 border-gray-50 hover:bg-gray-200">
                                <td class="p-4 text-left w-52">{{customer.name}}</td>
                                <td class="p-4 text-left w-52">{{customer.email}}</td>
                                <td class="p-4 text-left w-52">{{customer.id}}</td>
                               
                                 <td><button @click="customerData(customer.id)" class="bg-green-400 hover:bg-green-500 px-5 py- text-white transition rounded-sm">Add</button></td>
                            </tr>
                        </tbody>
                    </table>

                      </div>
                 </div>
            </div>

           
        </div>
    </div>
</template>

<script setup>

import { Link,useForm,usePage,router } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

const page = usePage();
const products = page.props.products;
const customers = page.props.customers;


function previous(){
    router.get(page.props.products.prev_page_url);
}
function next(){
    router.get(page.props.products.next_page_url);
}

//product Details
const showProduct = ref(false);
const showAddProduct = ref(false);

const selectProduct = ref();

async function productDetails(id){
    showProduct.value = true;
    const response = await axios.get(`/product/${id}`);
    selectProduct.value = response.data.data;
    
}

const product = useForm({
    id:0,
    name:'',
    price:0,
    quantity:0,
})

async function addProduct(id){
    showAddProduct.value = true;
    const response = await axios.get(`/product/${id}`);
    product.id = response.data.data.id;
    product.name = response.data.data.name;
    product.price = response.data.data.price;
   
}

//customer data
const customer = useForm({
    name:'',
    email:'',
    mobile:'',
})
async function customerData(id){

    const response = await axios.get(`/customer/${id}`);
     customer.name = response.data.customer.name;
     customer.email = response.data.customer.email;
     customer.mobile = response.data.customer.mobile;
    
}





</script>

