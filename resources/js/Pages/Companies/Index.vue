<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { ExportOutlined, EditOutlined, DeleteOutlined } from '@ant-design/icons-vue';

const page = usePage();

const props = defineProps({
    companies: Object
});

const columns = [
    {
        title: 'Index',
        dataIndex: 'id',
        key: 'id',
    },
    {
        title: 'Name',
        dataIndex: 'name',
        key: 'name',
    },
    {
        title: 'Email',
        dataIndex: 'email',
        key: 'email',
    },
    {
        title: 'Website',
        key: 'website',
        dataIndex: 'website',
    },
    {
        title: 'Action',
        key: 'action',
    },
];

const dataSource = computed(() => props.companies);
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
                    <div class="p-6 text-gray-900 overflow-x-auto">
                        <a-table :dataSource="dataSource" :columns="columns">
                            <template #bodyCell="{ column, record }">
                                <template v-if="column.key === 'name'">
                                    <Link :href="route('companies.show', record.id)">
                                        <a-avatar v-if="record.logo" :src="record.logo" shape="square" />
                                        <a-avatar v-else style="background-color: #722ed1" shape="square">
                                            {{ record.name.charAt(0).toUpperCase() }}
                                        </a-avatar>
                                        <span class="font-medium ml-2 text-blue-600 hover:underline">
                                            {{ record.name }}
                                        </span>
                                    </Link>
                                </template>
                                <template v-else-if="column.key === 'website'">
                                    <a class="flex items-center" :href="record.website" target="_blank"
                                        rel="noopener noreferrer">
                                        <span style="margin-right: 3px;">{{ record.website }}</span>
                                        <export-outlined />
                                    </a>
                                </template>
                                <template v-else-if="column.key === 'action'">
                                    <span>
                                        <span class="">
                                            <Link :href="route('companies.edit', record.id)">
                                                <a class="text-yellow-500">
                                                    Edit <edit-outlined />
                                                </a>
                                            </Link>
                                        </span>
                                        <a-divider type="vertical" />
                                        <a class="text-red-500">
                                            Delete <delete-outlined />
                                        </a>
                                    </span>
                                </template>
                            </template>
                        </a-table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>