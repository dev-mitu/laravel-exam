<script setup>
import { Link, router } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";

defineProps({
    categories: Array,
});
</script>

<template>
    <Head title="category & Goals" />
    <!-- Page Title -->
    <div class="w-full pb-5">
        <button>
            <Link
                :href="route('category.create')"
                class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
            >
            Category Create
            </Link>
        </button>
    </div>

    <div
        class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
    >
        <div class="relative overflow-x-auto">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-blue-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th class="px-4 py-2 text-center">name</th>
            <th class="px-4 py-2 text-center">Image</th>
            <th class="px-4 py-2 text-center">Edit</th>
            <th class="px-4 py-2 text-center">Delete</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="category in categories" :key="category.id">
            <td class="px-4 py-2 text-center">
                {{ category.name }}
            </td>
            <td class="px-4 py-2 text-center">
                <!-- Centering the image inside the <td> -->
                <div class="flex justify-center items-center">
                    <img
                        :src="category.image"
                        :alt="category.name"
                        class="max-h-20 max-w-20 object-cover text-center rounded-full border border-blue-300 p-2"
                    />
                </div>
            </td>
            <td class="px-4 py-2 text-center">
                <Link
                    :href="route('category.edit', category.id)"
                    class="text-green-500 hover:underline"
                >
                    Edit
                </Link>
            </td>
            <td class="px-4 py-2 text-center">
                <Link
                    :href="route('category.delete', category.id)"
                    method="DELETE"
                    class="text-red-500 hover:underline"
                >
                    Delete
                </Link>
            </td>
        </tr>
    </tbody>
</table>

            </div>
        </div>
    </div>
</template>

<style scoped>
/* Add any additional custom styles here if needed */
</style>
