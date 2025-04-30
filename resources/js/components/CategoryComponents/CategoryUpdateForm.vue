<script setup>
import { Link,useForm,usePage,router} from '@inertiajs/vue3';

import { ref } from 'vue';
import { useToast } from 'vue-toast-notification';

const toast = useToast();
const page = usePage();

const params = new URLSearchParams(window.location.search);

const id = ref(params.get('id'));
const item = page.props.category;


const form = useForm({
    name: item.name,
});

const updateCategory = ()=>{
    form.put(`/update-category/${item.id}`,{
        onSuccess:()=>{
            if(page.props.flash.status == true){
                toast.success(page.props.flash.message,{
                    position:'top-right',
                    duration:2000,
                })

                setTimeout(()=>{
                    // window.location.href = '/CategoryPage'
                    router.get('/CategoryPage')
                    
                },2000)
            }
            else{
                toast.error(page.props.flash.message,{
                    position:'top-right',
                    duration:2000,
                })
                setTimeout(()=>{
                    router.get('/categoryUpdatePage')
                    
                },2000)
            }

        }
    })
}


</script>


<template>

<div
        id="categoryModal"
        
        class=" flex items-center justify-center bg-opacity-50"
    >
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Create New Category</h2>
            <form @submit.prevent="onSubmit">
                <input
                   v-model="form.name"
                    type="text"
                    placeholder="Category Name"
                    class="border p-2 w-full mb-4 rounded"
                />

                <div class="flex justify-end gap-2">
                    <!-- Cancel button -->
                    <Link
                        href="/CategoryPage"
                        
                        class="bg-gray-300 px-4 py-2 rounded"
                    >
                        Cancel
                    </Link>
                    <!-- onclick="document.getElementById('categoryModal').classList.add('hidden')" -->
                    <!-- Save button -->
                    <button @click="updateCategory()"
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded"
                    >
                        change
                    </button>
                </div>
            </form>
        </div>
    </div>


</template>

<style scoped>

</style>