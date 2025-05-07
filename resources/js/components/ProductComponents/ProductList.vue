
<template>
    <div class="container mx-auto bg-zinc-100 shadow-md p-5">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <p>Search Product</p>
                <input
                    type="search"
                    class="border border-gray-300 rounded-lg p-2 outline-none"
                />
            </div>
            <div>
                <button
                    class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-2 rounded-sm transition ease-in-out duration-300 delay-150 hover:-translate-y-1 hover:scale-110"
                    @click="showForm = true"
                >
                    Create Product
                </button>
            </div>
        </div>

        <table class="w-full mt-5 auto-table text-sm md:text-base">
            <thead class="bg-white">
                <tr class="">
                    <th class="p-4 text-left">Product Id</th>
                    <th class="p-4 text-left">Name</th>
                    <th class="p-4 text-left">Category Name</th>
                    <th class="p-4 text-left">description</th>
                    <th class="p-4 text-left">Price</th>
                    <th class="p-4 text-left">Image</th>
                    <th class="p-4 text-left">Action</th>
                </tr>
            </thead>

            <tbody>
                <tr class="border border-b-4 border-red-50 hover:bg-gray-200" v-for="(product,index) in products.data" :key="index">
                    <td class="p-4 text-left w-24">{{ product.id }}</td>
                    <td class="p-2 text-left w-40">{{ product.name }}</td>
                    <td class="p-2 text-left w-40">{{ product.category.name }}</td>
                    <td class="p-2 text-left w-96">{{ product.description }}</td>
                    <td class="p-2 text-left w-40">{{ product.price }}</td>
                    <td class="p-2 text-left"><img :src="product.image" alt="" class="w-16 h-16 bg-gray-50 p-2 rounded-sm"></td>
                     <td class="flex flex-row gap-2 mt-6">
                        <Link :href="`/product-edit?id=${product.id}`" class="border-2 border-green-300 hover:border-green-700 hover:bg-green-400 hover:text-white rounded-md py-1 px-4 transition ease-in-out duration-300">Edit</Link>
                        <button  @click="destroy(product.id)" class="border-2 ml-5 border-red-300  hover:border-red-700 hover:bg-red-600 hover:text-white  rounded-md py-1 px-4 transition ease-in-out duration-300">Delete</button>
                     </td>
                    
                </tr>
                
            </tbody>
        </table>

        <div class="mt-5">
            <div class="flex gap-5">
                <button class="border border-green-300 hover:border-green-700 rounded-md py-2 px-6 transition ease-in-out duration-300 hover:bg-red-100" @click="previous">previous</button>
                <button >{{ products.current_page }}</button>
                <button class="border border-green-300 hover:border-green-700 rounded-md py-2 px-6 transition ease-in-out duration-300 hover:bg-red-100" @click="next">next</button>
            </div>

        </div>
      
    </div>

    <div v-show="showForm" class="fixed inset-0 sm:flex items-center justify-center bg-opacity-50 bg-black" >
        <div class="bg-white py-5 px-12 rounded-lg w-[400px] md:w-[600px] mx-auto">
            <h2 class="text-xl font-bold mb-4">Add a New Product</h2>
            <form  @submit.prevent="saveProduct" class="mb-4" enctype="multipart/form-data">
                <div class="grid md:grid-cols-2  gap-4 mb-4">
                   <div class="md:col-span-2">
                    <label for="customerName">Product Name</label>
                    <input v-model="form.name" type="text" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
                   </div>
                   <div>
                    <label for="description">Description</label>
                    <textarea v-model="form.description" name="" id="" rows="2" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md"></textarea>
                   </div>
                   <div>
                    <label for="price">Price</label>
                    <input v-model="form.price"  type="digits" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
                   </div>
                   <div>
                    <label for="category_id">Category_id</label>
                    <input v-model="form.category_id"  type="number" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" />
                   </div>
                   <div class="md:col-span-2">
                    <label for="image">Image</label>
                    <input type="file" placeholder="Customer Name" class="border border-gray-300  p-2 mb-4 w-full outline-none focus focus:border-sky-500 rounded-md" @change="imageHandle"/>
                   </div>
                   
                </div>
                
               <div class="flex justify-start gap-10 mt-4">
                    
                <button @click="showForm = false" type="button"  class="bg-red-500 text-white py-2 px-6 rounded-sm transition hover:-translate-y-0.5 hover:scale-110 duration-200 delay-150">Cancel</button>
                <button  type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-sm transition hover:-translate-y-0.5 hover:scale-110 duration-200 delay-150">Save</button>
               </div>
            </form>
        </div>
    </div>


  

</template>

<script setup>
import { ref } from 'vue';
import { Link,usePage,router,useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';

const page = usePage();
const toast = useToast();

const products = page.props.products;

const showForm = ref(false);

const previous =()=>{
    router.get(page.props.products.prev_page_url);
}
const next =()=>{
    router.get(page.props.products.next_page_url);
}

// const search = ref('');
// const productData = ref(products.data);

// const searchProduct = ()=>{

//      return productData.filter(product=>{
//         return product.toLowerCase().includes(search.toLowerCase());
//      })
// }

const form = useForm({
    name:'',
    description:'',
    price:0,
    category_id:0,
    image:''
})

const imageHandle = (event) => {
    form.image = event.target.files[0];
};

const saveProduct = () =>{

    form.post('/create-product',{

          onSuccess:()=>{
                if(page.props.flash.status == true){
                    toast.success('product create successfully', {
                        position: "top-right",
                        duration: 2000,
                        dismissible: true,
                        type: "success",
                    });
                    
                    setTimeout(() => {
                        showForm.value = false;
                        window.location.reload();
                    },1000);
                }
                else{                
                    toast.error(page.props.flash.message, {
                        position: "top-right",
                        duration: 2000,
                        dismissible: true,
                        type: "error",
                    });
                    
                }
          }
    })

}

//product delete sections

const destroy=(id)=>{

    if(confirm("Are you sure you want to delete this product?")){
       
        router.delete(`/destroy-product/${id}`,{
            onSuccess:()=>{
                if(page.props.flash.status == true){
                    toast.success('product delete successfully',{
                        position:'top-right',
                        duration:2000,
                    })
                   setTimeout(()=>{
                       window.location.reload();
                   },2000)
                }
                else{
                    toast.error(page.props.flash.message, {
                        position: "top-right",
                        duration: 2000,
                        dismissible: true,
                        type: "error",
                    });
                }
            }
        })

    }

}

</script>
