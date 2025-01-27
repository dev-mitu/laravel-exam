<script setup>
import { Head, Link, useForm, router } from "@inertiajs/vue3";

const props = defineProps({
    studentprofile: Object,
});

const form = useForm({
    name: props.studentprofile?.name || "",
    mobile: props.studentprofile?.mobile || "",
    email: props.studentprofile?.email || "",
    description: props.studentprofile?.description || "",
    image: props.studentprofile?.image || null,
});

const submit = () => {
    router.post(
        route("studentprofile.update", {
            studentprofile: props.studentprofile.id,
        }),
        {
            _method: "put",
            name: form.name,
            mobile: form.mobile,
            email: form.email,
            description: form.description,
            image: form.image,
        }
    );
};
</script>

<template>
    <div
        class="bg-white dark:bg-gray-800 p-4 shadow rounded-lg max-w-5xl mx-auto"
    >
        <Head title="Banner Edit" />

        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >Title (English)</label
                    >
                    <input
                        v-model="form.name"
                        type="text"
                        id="name"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Enter Title in English"
                        required
                    />
                </div>

                <div>
                    <label
                        for="mobile"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >Mobile</label
                    >
                    <input
                        v-model="form.mobile"
                        type="text"
                        id="mobile"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Enter Mobile Number"
                        required
                    />
                </div>
                <div>
                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >Email</label
                    >
                    <input
                        v-model="form.email"
                        type="email"
                        id="email"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Enter Email"
                        required
                    />
                </div>

                <!-- Description (Bengali) -->
                <div>
                    <label
                        for="description"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >Description</label
                    >
                    <textarea
                        v-model="form.description"
                        type="text"
                        id="description"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Enter Description"
                    />
                </div>

                <!-- Image Upload -->
                <div class="col-span-2">
                    <div class="mb-5 col-span-1 md:col-span-2">
                        <label
                            for="image"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Image Upload</label
                        >
                        <input
                            type="file"
                            id="image"
                            @input="form.image = $event.target.files[0]"
                            class="bg-white-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        />

                        <!-- Image Preview -->
                        <div v-if="props.studentprofile.image" class="mt-4">
                            <img
                                :src="`/${props.studentprofile?.image}`"
                                alt="Uploaded image"
                                class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button
                    type="submit"
                    class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg shadow focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
</template>
