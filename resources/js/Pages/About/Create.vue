<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    first_name: "",
    last_name: "",
    mobile: "",
    description: "",
    image: null,
});

// You don't need to use defineProps manually here
defineProps({
    errors: Object,
});

const submit = () => {
    form.post(route("about.store"));
};
</script>

<template>
    <Head title="Mitur Create" />

    <div
        class="mt-8 w-full md:w-[75%] mx-auto bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 p-8"
    >
        <form @submit.prevent="submit" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label
                        for="first_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >first_name</label
                    >
                    <input
                        id="first_name"
                        v-model="form.first_name"
                        class="bg-gray-50 dark:bg-dark-primary border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                        placeholder="Enter first_name"
                        rows="4"
                    />
                    <div class="text-red-400 text-sm mt-1" v-if="errors.first_name">
                        {{ errors.first_name }}
                    </div>
                </div>

                <div>
                    <label
                        for="last_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >last_name</label
                    >
                    <input
                        id="last_name"
                        v-model="form.last_name"
                        class="bg-gray-50 dark:bg-dark-primary border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                        placeholder="Enter last_name"
                        rows="4"
                    />
                    <div class="text-red-400 text-sm mt-1" v-if="errors.last_name">
                        {{ errors.last_name }}
                    </div>
                </div>

                <div>
                    <label
                        for="mobile"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >mobile</label
                    >
                    <input
                        id="mobile"
                        v-model="form.mobile"
                        class="bg-gray-50 dark:bg-dark-primary border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                        placeholder="Enter mobile"
                        rows="4"
                    />
                    <div class="text-red-400 text-sm mt-1" v-if="errors.mobile">
                        {{ errors.mobile }}
                    </div>
                </div>

                <div>
                    <label
                        for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >description</label
                    >
                    <textarea
                        id="description"
                        v-model="form.description"
                        class="bg-gray-50 dark:bg-dark-primary border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                        placeholder="Enter description"
                        rows="4"
                    ></textarea>
                    <div
                        class="text-red-400 text-sm mt-1"
                        v-if="errors.description"
                    >
                        {{ errors.description }}
                    </div>
                </div>

                <div>
                    <label
                        for="image"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >image</label
                    >
                    <input
                        id="image"
                        type="file"
                        @change="(e) => (form.image = e.target.files[0])"
                        class="bg-gray-50 dark:bg-dark-primary border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                        placeholder="Enter image"
                    />

                    <div class="text-red-400 text-sm mt-1" v-if="errors.image">
                        {{ errors.image }}
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button
                    type="submit"
                    class="py-3 px-6 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md"
                >
                    Submit
                </button>
            </div>
        </form>
    </div>
</template>

<style></style>

