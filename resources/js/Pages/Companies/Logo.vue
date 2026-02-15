<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ company: Object });

const form = useForm({
    logo: null,
});

const previewUrl = ref(null);

const handleFileChange = (e) => {
    const file = e.target.files[0];
    form.logo = file;
    if (file) {
        previewUrl.value = URL.createObjectURL(file);
    }
};

const submit = () => {
    form.post(route('companies.updateLogo', props.company.id));
};

</script>

<template>

    <Head :title="'Edit Logo ' + props.company.name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Logo {{ props.company.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col items-center gap-6">
                            <div class="flex gap-8 items-center">
                                <div class="text-center">
                                    <p class="text-sm text-gray-500 mb-2">Current Logo</p>
                                    <a-avatar :size="200" :src="company.getLogoUrlAttribute" shape="square" />
                                </div>

                                <div v-if="previewUrl" class="text-center">
                                    <p class="text-sm text-blue-500 mb-2">New Preview</p>
                                    <a-avatar :size="200" :src="previewUrl" shape="square" />
                                </div>
                            </div>

                            <form @submit.prevent="submit" class="w-full">
                                <input type="file" @change="handleFileChange" accept="image/*"
                                    class="mb-4 block w-full border p-2" />

                                <div v-if="form.errors.logo" class="text-red-500 mb-4">{{ form.errors.logo }}</div>

                                <div class="flex gap-4">
                                    <Link :href="route('companies.show', company.id)">
                                        <a-button>Cancel</a-button>
                                    </Link>
                                    <a-button type="primary" :loading="form.processing" @click="submit">
                                        Upload New Logo
                                    </a-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>