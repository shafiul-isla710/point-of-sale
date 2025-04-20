
<template>

<Navber></Navber>

<div class="flex flex-col gap-4 h-screen">
  <section id="hero">
        <div data-aos="fade-down" class="mx-auto sm:px-7 px-4 max-w-screen-xl py-20 text-center flex flex-col">
            <h1 class="pb-2 text-3xl md:text-6xl font-bold max-w-[900px] mx-auto text-slate-700">Create your own App and
                boost
                your business.</h1>
            <p class="pb-10 text-lg text-gray-600 max-w-[600px] mx-auto">
                Generate, manage and track your presence online easily.
            </p>
            <div class="flex mx-auto gap-0 md:gap-10 items-center">
                <div class="hidden md:block ml-[-96px]">
                    <img src="./imgs/home-arrow.svg" alt="">
                </div>
                <a href="/"
                    class="transition ease-in-out delay-150 border-2 border-indigo-500 py-2 px-10 rounded-full text-white-600 font-bold bg-indigo-500 text-white hover:bg-white hover:text-indigo-600 ">Let's
                    start</a>
            </div>
           
        </div>
    </section>

    <section id="prices">
        <div class="mx-auto sm:px-7 px-4 max-w-screen-lg py-20">
            <h2 class="text-center text-3xl md:text-5xl font-bold pb-2 text-slate-700">
                Choose your plan
            </h2>
            <div class="max-w-[300px] mx-auto mb-10">
                <div
                    class="inline-flex w-full border border-blue-600 rounded-lg mt-6 overflow-hidden bg-chalk p-0.5 z-0">
                    <button
                        class="text-white font-medium border rounded-md transition w-full py-2 block border-transparent px-8 text-xs bg-blue-600"
                        type="button">
                        Monthly
                    </button>
                    <button
                        class="text-black font-medium border rounded-md transition w-full py-2 block border-transparent px-8 text-xs bg-white"
                        type="button">
                        Annual
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-6 lg:grid-cols-12 gap-10">
                <div class="order-last lg:order-first col-span-6">
                    <div class="w-full flex justify-between items-center bg-white border rounded-lg p-10 gap-10">
                        <div class="flex flex-col gap-6">
                            <span class="text-lg">Basic plan</span>
                            <span class="text-gray-600 text-sm">Suitable for those that want to start.</span>
                        </div>
                        <div class="flex flex-col">
                            <strong class="text-5xl">15€</strong>
                            <span>Per month</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-4 py-10">
                        <div class="col-span-2">
                            <div class="flex gap-2 items-center">
                                <i
                                    class="bi bi-check-lg text-white bg-green-500 rounded-full w-6 h-6 block text-center"></i>
                                <span class="text-sm sm:text-lg">3 mockup design</span>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="flex gap-2 items-center">
                                <i
                                    class="bi bi-check-lg text-white bg-green-500 rounded-full w-6 h-6 block text-center"></i>
                                <span class="text-sm sm:text-lg">2 websites</span>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="flex gap-2 items-center">
                                <i
                                    class="bi bi-check-lg text-white bg-green-500 rounded-full w-6 h-6 block text-center"></i>
                                <span class="text-sm sm:text-lg">Unlimited users</span>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="flex gap-2 items-center">
                                <i
                                    class="bi bi-check-lg text-white bg-green-500 rounded-full w-6 h-6 block text-center"></i>
                                <span class="text-sm sm:text-lg">Basic support</span>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="flex gap-2 items-center">
                                <i class="bi bi-x text-white bg-red-500 rounded-full w-6 h-6 block text-center"></i>
                                <span class="text-sm sm:text-lg">Full support</span>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="flex gap-2 items-center">
                                <i class="bi bi-x text-white bg-red-500 rounded-full w-6 h-6 block text-center"></i>
                                <span class="text-sm sm:text-lg">Advanced analytics</span>
                            </div>
                        </div>
                    </div>
                    <a href="#"
                        class="block rounded-lg w-full text-black text-center py-2 px-4 bg-white hover:text-white border-2 hover:border-blue-600 hover:bg-blue-600">Get
                        started</a>
                </div>
                <div class="col-span-6">
                    <div
                        class="w-full flex justify-between items-center bg-blue-600 text-white border rounded-lg p-10 gap-10">
                        <div class="flex flex-col gap-6">
                            <span class="text-lg">Pro plan</span>
                            <span class="text-gray-200 text-sm">Suitable for those that want to grow.</span>
                        </div>
                        <div class="flex flex-col">
                            <strong class="text-5xl">45€</strong>
                            <span class="text-sm sm:text-lg">Per month</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-4 py-10">
                        <div class="col-span-2">
                            <div class="flex gap-2 items-center">
                                <i
                                    class="bi bi-check-lg text-white bg-green-500 rounded-full w-6 h-6 block text-center"></i>
                                <span class="text-sm sm:text-lg">3 mockup design</span>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="flex gap-2 items-center">
                                <i
                                    class="bi bi-check-lg text-white bg-green-500 rounded-full w-6 h-6 block text-center"></i>
                                <span class="text-sm sm:text-lg">4 websites</span>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="flex gap-2 items-center">
                                <i
                                    class="bi bi-check-lg text-white bg-green-500 rounded-full w-6 h-6 block text-center"></i>
                                <span class="text-sm sm:text-lg">Unlimited users</span>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="flex gap-2 items-center">
                                <i
                                    class="bi bi-check-lg text-white bg-green-500 rounded-full w-6 h-6 block text-center"></i>
                                <span class="text-sm sm:text-lg">Basic support</span>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="flex gap-2 items-center">
                                <i
                                    class="bi bi-check-lg text-white bg-green-500 rounded-full w-6 h-6 block text-center"></i>
                                <span class="text-sm sm:text-lg">Full support</span>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="flex gap-2 items-center">
                                <i
                                    class="bi bi-check-lg text-white bg-green-500 rounded-full w-6 h-6 block text-center"></i>
                                <span class="text-sm sm:text-lg">Advanced analytics</span>
                            </div>
                        </div>
                    </div>
                    <a href="#"
                        class="block text-center rounded-lg w-full text-white py-2 px-4 border bg-blue-600 hover:text-blue-600 hover:bg-white border-2 border-blue-600">Get
                        started</a>
                </div>
            </div>
        </div>
    </section>

</div>
</template>

<script setup>

import Navber from '../Pages/Navber.vue';


</script>