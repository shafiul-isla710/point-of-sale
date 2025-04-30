<template>
    <header class="max-w-lg mx-auto">
        <a href="#">
            <h1 class="text-4xl font-bold text-white text-center">Startup</h1>
        </a>
    </header>

    <main
        class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl"
    >
        <section>
            <h3 class="font-bold text-2xl">Registration</h3>
            <p class="text-gray-600 pt-2">Please enter your details.</p>
        </section>

        <section class="mt-10">
            <form
                action="#"
                @submit.prevent="onSubmit()"
                class="space-y-4"
                enctype="multipart/form-data"
            >
                <!-- Name Field -->
                <div>
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Name</label
                    >
                    <input
                        v-model="form.name"
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Enter your name"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                <!-- Email Field -->
                <div>
                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700"
                        >Email</label
                    >
                    <input
                        v-model="form.email"
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                <!-- Mobile Field -->
                <div>
                    <label
                        for="mobile"
                        class="block text-sm font-medium text-gray-700"
                        >Mobile</label
                    >
                    <input
                        v-model="form.mobile"
                        type="text"
                        id="mobile"
                        name="mobile"
                        placeholder="Enter your mobile number"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                <!-- Password Field -->
                <div>
                    <label
                        for="password"
                        class="block text-sm font-medium text-gray-700"
                        >Password</label
                    >
                    <input
                        v-model="form.password"
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label
                        for="image"
                        class="block text-sm font-medium text-gray-700"
                        >File or Image</label
                    >
                    <input
                        type="file"
                        id="confirm-password"
                        name="confirm_password"
                        placeholder="Confirm your password"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        @change="imageHandle"
                    />
                </div>

                <!-- Submit Button -->
                <div>
                    <button
                        type="submit"
                        class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Register
                    </button>
                </div>
            </form>
        </section>
    </main>

    <div class="max-w-lg mx-auto text-center mt-12 mb-6">
        <p class="text-white">
            Don't have an account?
            <a href="#" class="font-bold hover:underline">Sign up</a>.
        </p>
    </div>
</template>

<script setup>
import { Link, useForm, usePage, router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import { onMounted } from "vue";

const toast = useToast();

const form = useForm({
    name: "",
    email: "",
    mobile: "",
    password: "",
    image: "",
});

const imageHandle = (event) => {
    form.image = event.target.files[0];
};

const page = usePage();

const onSubmit = () => {
    form.post("/Registration", {
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toast.success(page.props.flash.message, {
                    position: "top-right",
                    duration: 2000,
                    dismissible: true,
                    pauseOnHover: true,
                    closeButton: true,
                });

                setTimeout(() => {
                    router.get("/LoginPage");
                },5000);
            } else {
                toast.error(page.props.flash.message, {
                    position: "top-right",
                    duration: 5000,
                    dismissible: true,
                    pauseOnHover: true,
                    closeButton: true,
                });
            }
        },
    });
};
</script>
