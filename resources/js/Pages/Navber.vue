<script setup>
 import { Link } from '@inertiajs/vue3';

</script>


<template>

<header class="bg-gray-50 text-indigo-700 w-dvh mx-auto p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            
            <div class="flex items-center space-x-4 gap-5">
                <h1 class="text-2xl font-bold">Point of sale</h1>
                <Link href="/" class="hover:underline">Home</Link>
                <Link href="#" class="hover:underline">About</Link>
            </div>
            <nav>
                <ul class="flex space-x-4">
                    <li><Link href="registrationPage" class="hover:underline">Registration</Link></li>
                    <li><Link href="LoginPage" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-gray-200">Login</Link></li>
                </ul>
            </nav>
        </div>
    </header>


</template>

<style scoped>

</style>