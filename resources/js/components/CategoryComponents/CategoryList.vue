<template>
    <div class="container mx-auto mt-4 bg-white p-4 rounded-sm shadow-md">
        <div class="grid grid-cols-1">
            <div class="sm:flex justify-between pb-3 items-center">
                <div>
                    <span class="text-lg">Search Category: </span>
                    <input
                        type="search"
                        class="border border-gray-300 rounded-sm p-2 outline-none"
                        placeholder="Search..."
                        v-model="searchValue"
                    />
                </div>
                <div>
                    <button
                        @click="showForm = true"
                        class="text-sm bg-blue-500 hover:bg-blue-600 text-white py-2 px-2 rounded-sm transition ease-in-out duration-300 delay-150 hover:-translate-y-1 hover:scale-110"
                    >
                        Create Category
                    </button>
                </div>
            </div>

            <EasyDataTable
                :headers="header"
                :items="item"
                :rows-per-page="10"
                :search-value="searchValue"
                alternating
            >
                <template #item-number="{ id }">
                    <Link
                        class="py-2 px-3 text-sm bg-green-500 text-white rounded-sm mx-2"
                       :href="`/categoryUpdatePage?id=${id}`"
                    >
                        Edit
                    </Link>
                </template>

                <template #item-delete="{ id }">
                    <button
                        @click="deleteCategory(id)"
                        class="py-2 px-3 bg-red-500 text-white rounded-sm mx-2 text-sm"
                    >
                        Delete
                    </button>
                </template>
            </EasyDataTable>
        </div>
    </div>

    <div
        id="categoryModal"
        v-show="showForm"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
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
                    <button
                        type="button"
                        @click="showForm = false"
                        class="bg-gray-300 px-4 py-2 rounded"
                    >
                        Cancel
                    </button>
                    <!-- onclick="document.getElementById('categoryModal').classList.add('hidden')" -->
                    <!-- Save button -->
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { usePage, Link, useForm, router } from "@inertiajs/vue3";
import { set } from "nprogress";
import { ref, onMounted } from "vue";
import { useToast } from "vue-toast-notification";

const showForm = ref(false);
const searchValue = ref("");

const toast = useToast();
const page = usePage();

const item = page.props.list;

const header = ref([
    { text: "No", value: "id" },
    { text: "Category Name", value: "name" },
    { text: "update", value: "number" },
    { text: "delete", value: "delete" },
]);



const form = useForm({
    name: "",
});

const onSubmit = () => {
    form.post("/create-category", {
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toast.success(page.props.message, {
                    position: "top-right",
                    duration: 2000,
                    dismissible: true,
                    type: "success",
                });

                window.location.reload();
                setTimeout(() => {
                    showForm.value = false;
                    form.reset();
                });
            } else {
                toast.error(page.props.flash.message, {
                    position: "top-right",
                    duration: 2000,
                    dismissible: true,
                    type: "error",
                });

                console.log(page.props.flash.errors);

                setTimeout(() => {
                    showForm.value = false;
                    form.reset();
                }, 2000);
            }
        },
    });
};

const deleteCategory = (id) => {
    const text = "Are you sure you want to delete this category?";

    if (confirm(text) == true) {
        toast.success("Category Deleted Successfully", {
            position: "top-right",
            duration: 2000,
            dismissible: true,
            type: "success",
        });

        router.get(`/delete-category/${id}`, {
            onSuccess: () => {
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            },
        });
        console.log(id);
    } else {
        text = "cancelled";
    }
};
</script>
