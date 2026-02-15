<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    totalCompanies: Number,
    totalEmployees: Number
});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">

                    <div class="overflow-hidden bg-white border-l-4 border-blue-500 shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="text-sm font-medium text-gray-500 uppercase">Total Companies</div>
                            <div class="mt-2 text-3xl font-bold text-gray-900">{{ totalCompanies }}</div>
                        </div>
                    </div>

                    <div class="overflow-hidden bg-white border-l-4 border-green-500 shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="text-sm font-medium text-gray-500 uppercase">Total Employees</div>
                            <div class="mt-2 text-3xl font-bold text-gray-900">{{ totalEmployees }}</div>
                        </div>
                    </div>

                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Welcome back! You are managing <b>{{ totalCompanies }}</b> companies today.
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
