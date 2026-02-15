<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const labelCol = { style: { width: '150px' } };
const wrapperCol = { span: 14 };

const formCompany = useForm({
    name: '',
    email: '',
    website: '',
    logo: null,
});

const onFinish = () => {
    formCompany.post(route('companies.store'));
};
</script>

<template>

    <Head title="Add Company" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Add Company
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <a-form :model="formCompany" :label-col="labelCol" :wrapper-col="wrapperCol" @finish="onFinish"
                            autocomplete="off">
                            <a-form-item label="Company name" name="name" :rules="[
                                { required: true, message: 'Company name is required.' },
                                { min: 3, message: 'Company name must be at least 3 characters.' }]"
                                :validate-status="formCompany.errors.name ? 'error' : ''"
                                :help="formCompany.errors.name">
                                <a-input v-model:value="formCompany.name" />
                            </a-form-item>
                            <a-form-item label="Email" name="email" :rules="[
                                { required: false },
                                { type: 'email', message: 'Please enter a valid email address.' }]"
                                :validate-status="formCompany.errors.email ? 'error' : ''"
                                :help="formCompany.errors.email">
                                <a-input v-model:value="formCompany.email" />
                            </a-form-item>
                            <a-form-item label="Website" name="website" :rules="[
                                { required: false },
                                { type: 'url', message: 'Enter a valid URL (e.g., https://example.com).' }]"
                                :validate-status="formCompany.errors.website ? 'error' : ''"
                                :help="formCompany.errors.website">
                                <a-input v-model:value="formCompany.website" />
                            </a-form-item>
                            <a-form-item label="Logo">
                                <a-input v-model:value="formCompany.logo" disabled />
                            </a-form-item>
                            <a-form-item :wrapper-col="{ span: 14, offset: 4 }">
                                <Link :href="route('companies.index')">
                                    <a-button :disabled="formCompany.processing">Cancel</a-button>
                                </Link>
                                <a-button style="margin-left: 10px" type="primary" html-type="submit"
                                    :disabled="formCompany.processing">Create</a-button>
                            </a-form-item>
                        </a-form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>