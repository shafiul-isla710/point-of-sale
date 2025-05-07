

<template>
  
        <div class="md:w-[750px] h-[700px] mx-auto bg-white rounded-lg p-10 shadow-lg">
            <div>
                <h1 class="text-2xl font-bold">Updata your Product</h1>
                <form @submit.prevent="updateProduct()" class="mt-6">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label
                                for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Product Name</label
                            >
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type product name"
                                v-model="form.name"
                            />
                        </div>
                        <div class="w-full">
                            <label
                                for="brand"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Description</label
                            >
                            <textarea
                                id="description"
                                rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your description here"
                                v-model="form.description"
                            ></textarea>
                        </div>
                        <div class="w-full">
                            <label
                                for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Price</label
                                
                            >
                            <input
                                type="number"
                                name="price"
                                id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="$2999"
                               v-model="form.price"
                            />
                        </div>
                        <div>
                            <label
                                for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Category</label
                            >
                            <select
                                id="category"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                v-model="form.category_id"
                            >
                                <option selected="">Select category</option>
                                <option  value="6">Food product</option>
                                <option value="7">Electronic Product</option>
                                <option value="8">Mechanical Pats</option>
                            </select>
                        </div>
                        <div>
                            <label
                                for="item-weight"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Item Weight (kg)</label
                            >
                            <input
                                type="number"
                                name="item-weight"
                                id="item-weight"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="12"
                              
                            />
                        </div>
                        <div class="sm:col-span-2">
                            <label
                                for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Image</label
                            >
                            <div  class="flex flex-row gap-5 items-center">
                                <img class="w-20 h-20 bg-white" src="" alt="" />
                                <input type="file" name="image" id="image" />
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row  gap-10 w-full">
                        <Link
                            href="/product-page"
                            
                            class="items-center w-1/2 py-3 mt-4 sm:mt-6 text-md font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800"
                        >
                            Cancel
                        </Link>
                        <button
                            type="submit"
                            class=" items-center w-1/2 py-3 mt-4 sm:mt-6 text-md font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
   
</template>

<script setup>

import { Link,useForm,usePage,router } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';

const page = usePage();
const products = page.props.product;
const toast = useToast();

console.log(products)

const form = useForm({
    name:products.name,
    description:products.description,
    price:products.price,
    category_id:products.category_id,
    item_weight:products.item_weight,
});

const updateProduct = () =>{
    form.post(`/update-product/${products.id}`,{
        onSuccess:()=>{
            if(page.props.flash.status == true){
                toast.success('product update successfully', {
                    position:'top-right',
                    duration:2000,
                })
                setTimeout(()=>{
                   router.get('/product-page')
                },2000)
            }
        }
    });
}



</script>
