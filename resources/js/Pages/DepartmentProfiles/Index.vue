<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Link } from '@inertiajs/vue3';
</script>

<script>
    export default {
        props: ['department_profiles'],
    }
</script>
<template>
    <AppLayout title="View Department Profile List">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                View Department Profile List
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link class="mb-6" :href="route('department_profiles.create', { currentDept: $page.props.currentDept })"><PrimaryButton class="mb-4">Create Department Profile</PrimaryButton></Link>



<div class="relative overflow-x-auto dark:text-gray-300">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Profile name
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="department_profile in department_profiles.data" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ department_profile.name }}
                </th>
                <td class="px-6 py-4">
                    <Link :href="route('department_profiles.edit', { 
                        currentDept: $page.props.currentDept,
                         department_profile: department_profile 
                    })"><PrimaryButton class="mr-2">Edit</PrimaryButton></Link>
                    <Link :href="route('department_profiles.destroy', {
                        currentDept: $page.props.currentDept,
                        department_profile: department_profile
                    })" method="DELETE" as="button"><DangerButton>Delete</DangerButton></Link>
                </td>
            </tr>

        </tbody>
    </table>
</div>

            </div>
        </div>
    </AppLayout>
</template>
