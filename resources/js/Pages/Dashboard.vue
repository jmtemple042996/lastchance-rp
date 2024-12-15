<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-4 dark:text-gray-300">
                    <div class="mb-4 font-bold">Community</div>
                        <Link :href="route('permissions.index', { currentDept: $page.props.currentDept})"><PrimaryButton class="mr-4">Permissions</PrimaryButton></Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
