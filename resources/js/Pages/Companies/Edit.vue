<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage, useForm } from '@inertiajs/vue3';

const labelCol = { style: { width: '150px' } };
const wrapperCol = { span: 14 };

const page = usePage();

const props = defineProps({ company: Object })

const formCompany = useForm({
    name: props.company.name,
    email: props.company.email,
    website: props.company.website,
});

const onFinish = () => {
    // alert('break');
    formCompany.patch(route('companies.update', props.company.id));
};
</script>

<template>

    <Head :title="'Edit ' + props.company.name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit {{ props.company.name }}
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
                            <a-form-item :wrapper-col="{ span: 14, offset: 4 }">
                                <Link :href="route('companies.show', [props.company.id])">
                                    <a-button style="margin-left: 10px" danger>Cancel</a-button>
                                </Link>
                                <a-button style="margin-left: 10px" type="primary" html-type="submit"
                                    :disabled="formCompany.processing">Save update</a-button>
                            </a-form-item>
                        </a-form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>