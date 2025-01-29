<script setup>
import { Link, router } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";

defineProps({
    about: Array,
});
</script>

<template>
    <Head title="about & Goals" />
    <!-- Page Title -->
    <div class="w-full pb-5">
        <button>
            <Link
                :href="route('about.create')"
                class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
            >
                About Create
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
            <th class="px-4 py-2 text-center">First_name</th>
            <th class="px-4 py-2 text-center">Last_name</th>
            <th class="px-4 py-2 text-center">Mobile</th>
            <th class="px-4 py-2 text-center">Description</th>
            <th class="px-4 py-2 text-center">Image</th>
            <th class="px-4 py-2 text-center">Edit</th>
            <th class="px-4 py-2 text-center">Delete</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="about in about" :key="about.id">
            <td class="px-4 py-2 text-center">
                {{ about.first_name }}
            </td>
            <td class="px-4 py-2 text-center">
                {{ about.last_name }}
            </td>
            <td class="px-4 py-2 text-center">
                {{ about.mobile }}
            </td>
            <td class="px-4 py-2 text-center">
                {{ about.description }}
            </td>
            <td class="px-4 py-2 text-center">
                <!-- Centering the image inside the <td> -->
                <div class="flex justify-center items-center">
                    <img
                        :src="about.image"
                        :alt="about.name"
                        class="max-h-20 max-w-20 object-cover text-center rounded-full border border-blue-300 p-2"
                    />
                </div>
            </td>
            <td class="px-4 py-2 text-center">
                <Link
                    :href="route('about.edit', about.id)"
                    class="text-green-500 hover:underline"
                >
                    Edit
                </Link>
            </td>
            <td class="px-4 py-2 text-center">
                <Link
                    :href="route('about.delete', about.id)"
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
