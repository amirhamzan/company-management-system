<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, } from '@inertiajs/vue3';

const labelCol = { style: { width: '150px' } };
const wrapperCol = { span: 14 };

defineProps({ company: Object })
</script>

<template>

    <Head :title="company.name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ company.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <a-form :model="company" :label-col="labelCol" :wrapper-col="wrapperCol">
                            <a-form-item label="Company name" name="name">
                                <a-input :value="company.name" disabled />
                            </a-form-item>
                            <a-form-item label="Email" name="email">
                                <a-input :value="company.email" disabled />
                            </a-form-item>
                            <a-form-item label="Website" name="website">
                                <a-input :value="company.website" disabled />
                            </a-form-item>
                            <a-form-item label="Logo">
                                <a-input :value="company.logo" disabled />
                            </a-form-item>
                            <a-form-item :wrapper-col="{ span: 14, offset: 4 }">
                                <Link :href="route('companies.index')">
                                    <a-button style="margin-left: 10px">To All Companies</a-button>
                                </Link>
                                <Link :href="route('companies.edit', [company.id])">
                                    <a-button style="margin-left: 10px" type="primary" class="rounded-xl">
                                        Edit Company
                                    </a-button>
                                </Link>
                            </a-form-item>
                        </a-form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>