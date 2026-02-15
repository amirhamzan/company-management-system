<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import { computed, createVNode } from 'vue';
import { ExportOutlined, EditOutlined, DeleteOutlined, ExclamationCircleOutlined } from '@ant-design/icons-vue';
import { Modal } from 'ant-design-vue';

const page = usePage();

const props = defineProps({
    employees: Object
});

const columns = [
    {
        title: 'Index',
        dataIndex: 'id',
        key: 'id',
    },
    {
        title: 'First Name',
        dataIndex: 'first_name',
        key: 'first_name',
    },
    {
        title: 'Last Name',
        dataIndex: 'last_name',
        key: 'last_name',
    },
    {
        title: 'Company',
        dataIndex: 'company_id',
        key: 'company_id',
    },
    {
        title: 'Email',
        dataIndex: 'email',
        key: 'email',
    },
    {
        title: 'Phone',
        key: 'phone',
        dataIndex: 'phone',
    },
    {
        title: 'Action',
        key: 'action',
    },
];

const dataSource = computed(() => props.employees.data);

const pagination = computed(() => ({
    total: props.employees.total,
    current: props.employees.current_page,
    pageSize: props.employees.per_page,
}));

const handleTableChange = (pag) => {
    router.get(
        route('employees.index'),
        { page: pag.current }
    );
};

const showDeleteConfirm = (selectedEmployee) => {
    Modal.confirm({
        title: 'Are you sure delete this employee?',
        icon: createVNode(ExclamationCircleOutlined),
        content: selectedEmployee.first_name + " " + selectedEmployee.last_name,
        okText: 'Yes',
        okType: 'danger',
        cancelText: 'No',
        onOk() {
            console.log(selectedEmployee);
            router.delete(route('employees.destroy', selectedEmployee.id));
        },
        onCancel() {
            console.log("Cancel delete " + selectedEmployee.name);
        },
    });
};
</script>

<template>

    <Head title="Employees" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Employees
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
                        <span>List of employees</span>
                        <Link :href="route('employees.create')">
                            <a-button type="primary" class="rounded-xl">
                                Add Employee
                            </a-button>
                        </Link>
                    </div>
                    <div class="p-6 text-gray-900 overflow-x-auto">
                        <a-table :dataSource="dataSource" :columns="columns" :pagination="pagination"
                            @change="handleTableChange">
                            <template #bodyCell="{ column, record }">
                                <template v-if="column.key === 'name'">
                                    <Link :href="route('employees.show', record.id)">
                                        <span class="font-medium ml-2 text-blue-600 hover:underline">
                                            {{ record.name }}
                                        </span>
                                    </Link>
                                </template>
                                <template v-else-if="column.key === 'company_id'">
                                    {{ record.company?.name || 'No Company' }}
                                </template>
                                <template v-else-if="column.key === 'action'">
                                    <span>
                                        <span class="">
                                            <Link :href="route('employees.edit', record.id)">
                                                <a class="text-yellow-500">
                                                    Edit <edit-outlined />
                                                </a>
                                            </Link>
                                        </span>
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