<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage, useForm } from '@inertiajs/vue3';

const labelCol = { style: { width: '150px' } };
const wrapperCol = { span: 14 };

const page = usePage();

const props = defineProps({
    employee: Object,
    companies: Object
});

const formEmployee = useForm({
    first_name: props.employee.first_name,
    last_name: props.employee.last_name,
    email: props.employee.email,
    phone: props.employee.phone,
    company_id: props.employee.company_id,
});

const onFinish = () => {
    formEmployee.patch(route('employees.update', props.employee.id));
};
</script>

<template>

    <Head :title="'Edit ' + employee.first_name + ' ' + employee.last_name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit {{ employee.first_name }} {{ employee.last_name }}
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
                    <div class="p-6 text-gray-900">
                        <a-form :model="formEmployee" :label-col="labelCol" :wrapper-col="wrapperCol" @finish="onFinish"
                            autocomplete="off">
                            <a-form-item label="Company" name="company_id" :rules="[
                                { required: true, message: 'The company is required.' }]"
                                :validate-status="formEmployee.errors.company_id ? 'error' : ''"
                                :help="formEmployee.errors.company_id">
                                <a-select v-model:value="formEmployee.company_id" placeholder="Select a company"
                                    show-search option-filter-prop="label">
                                    <a-select-option v-for="company in props.companies" :key="company.id"
                                        :value="company.id" :label="company.name">
                                        {{ company.name }} (ID: {{ company.id }})
                                    </a-select-option>
                                </a-select>
                            </a-form-item>
                            <hr class="p-2">
                            <a-form-item label="First name" name="first_name" :rules="[
                                { required: true, message: 'First name is required.' },
                                { min: 3, message: 'First name must be at least 2 characters.' }]"
                                :validate-status="formEmployee.errors.first_name ? 'error' : ''"
                                :help="formEmployee.errors.first_name">
                                <a-input v-model:value="formEmployee.first_name" />
                            </a-form-item>
                            <a-form-item label="Last name" name="last_name" :rules="[
                                { required: true, message: 'Last name is required.' },
                                { min: 3, message: 'Last name must be at least 2 characters.' }]"
                                :validate-status="formEmployee.errors.last_name ? 'error' : ''"
                                :help="formEmployee.errors.last_name">
                                <a-input v-model:value="formEmployee.last_name" />
                            </a-form-item>
                            <a-form-item label="Email" name="email" :rules="[
                                { required: false },
                                { type: 'email', message: 'Please enter a valid email address.' }]"
                                :validate-status="formEmployee.errors.email ? 'error' : ''"
                                :help="formEmployee.errors.email">
                                <a-input v-model:value="formEmployee.email" />
                            </a-form-item>
                            <a-form-item label="Phone" name="phone" :rules="[
                                { required: false },
                                { min: 5, message: 'Phone numbers must be at least 5 characters.' }]"
                                :validate-status="formEmployee.errors.phone ? 'error' : ''"
                                :help="formEmployee.errors.phone">
                                <a-input v-model:value="formEmployee.phone" />
                            </a-form-item>
                            <a-form-item :wrapper-col="{ span: 14, offset: 4 }">
                                <Link :href="route('employees.show', employee.id)">
                                    <a-button style="margin-left: 10px">Cancel</a-button>
                                </Link>
                                <a-button style="margin-left: 10px" type="primary" class="rounded-xl"
                                    :disabled="formEmployee.processing" html-type="submit">
                                    Save update
                                </a-button>
                            </a-form-item>
                        </a-form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>