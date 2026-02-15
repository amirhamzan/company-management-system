<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import { computed, createVNode } from 'vue';
import { ExportOutlined, EditOutlined, DeleteOutlined, ExclamationCircleOutlined } from '@ant-design/icons-vue';
import { Modal } from 'ant-design-vue';

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

const dataSource = computed(() => props.companies.data);

const pagination = computed(() => ({
    total: props.companies.total,
    current: props.companies.current_page,
    pageSize: props.companies.per_page,
}));

const handleTableChange = (pag) => {
    router.get(
        route('companies.index'),
        { page: pag.current }
    );
};

const showDeleteConfirm = (selectedCompany) => {
    Modal.confirm({
        title: 'Are you sure delete this company?',
        icon: createVNode(ExclamationCircleOutlined),
        content: selectedCompany.name,
        okText: 'Yes',
        okType: 'danger',
        cancelText: 'No',
        onOk() {
            console.log(selectedCompany);
            router.delete(route('companies.destroy', selectedCompany.id));
        },
        onCancel() {
            console.log("Cancel delete " + selectedCompany.name);
        },
    });
};
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
                        <a-table :dataSource="dataSource" :columns="columns" :pagination="pagination"
                            @change="handleTableChange">
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
                                        <Link :href="route('companies.edit', record.id)">
                                            <a-button class="text-yellow-500">
                                                Edit <edit-outlined />
                                            </a-button>
                                        </Link>
                                        <a-divider type="vertical" />
                                        <a-button danger @click="showDeleteConfirm(record)" class="text-red-500">
                                            Delete <delete-outlined />
                                        </a-button>
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