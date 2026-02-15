<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const page = usePage();

</script>

<template>

    <Head title="Companies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Companies
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 pb-0 text-gray-900" v-if="page.props.flash.success">
                        <a-space direction="vertical" style="width: 100%">
                            <a-alert :message="page.props.flash.success" type="success" show-icon />
                        </a-space>
                    </div>
                    <div class="p-6 text-gray-900 flex justify-between items-center">
                        <span>List of companies</span>
                        <Link :href="route('companies.create')">
                            <a-button type="primary" class="rounded-xl">
                                Add Company
                            </a-button>
                        </Link>
                    </div>
                    <div class="p-6 text-gray-900">
                        ...
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>