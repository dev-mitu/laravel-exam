<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";


const form = useForm({
    gmail: '',
    password: '',
});

// You don't need to use defineProps manually here
defineProps({
    errors: Object,
});

const submit = () => {
    form.post(route('home.store'));
};
</script>

<template>

    <Head title="Mitur Create" />
    <div class="mt-8 w-full md:w-[75%] mx-auto bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 p-8">
      <form @submit.prevent="submit" class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
          <div>
            <label for="gmail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">gmail</label>
            <input id="gmail" v-model="form.gmail" 
              class="bg-gray-50 dark:bg-dark-primary border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
              placeholder="Enter gmail" rows="4">
            <div class="text-red-400 text-sm mt-1" v-if="errors.gmail">{{ errors.gmail }}</div>
          </div>

          
          <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input id="password" v-model="form.password" 
              class="bg-gray-50 dark:bg-dark-primary border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
              placeholder="Enter password" rows="4">
            <div class="text-red-400 text-sm mt-1" v-if="errors.password">{{ errors.password }}</div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-6">
          <button type="submit"
            class="py-3 px-6 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md">
            Submit
          </button>
        </div>
      </form>
    </div>

</template>

<style></style>