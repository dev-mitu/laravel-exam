<script setup>
import { Head, useForm,router } from "@inertiajs/vue3";

const props = defineProps({
    home: Object,
});

const form = useForm({
    gmail: props.home?.gmail || '',
    password: props.home?.password || '',
});

const submit = () => {
  router.post(route('home.update', { home: props.home.id }), {
    _method: "put",
    gmail: form.gmail,
    password: form.password,
  });
};
</script>

<template>
    <div class="bg-white dark:bg-gray-800 p-4 shadow rounded-lg max-w-5xl mx-auto">
        <Head title="Aims & Goals Edit" />
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="gmail" class="block text-sm font-medium text-gray-700 dark:text-gray-300">gmail</label>
                    <input
                        v-model="form.gmail"
                        id="gmail"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Enter gmail"
                    />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">password</label>
                    <input
                        v-model="form.password"
                        id="password"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Enter password"
                        type="text"
                    />
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button
                    type="submit"
                    class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
</template>
