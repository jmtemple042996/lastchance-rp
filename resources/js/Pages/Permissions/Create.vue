<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
</script>

<script>
    export default {
        props: [],

        data() {
            return {
                form: useForm({
                    name: '',
                    scope: '',
                    slug: '',
                }),
            }
        }
    }
</script>
<template>
    <AppLayout title="Create Permission">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create Permission
            </h2>
        </template>

        <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-4">

                        <form @submit.prevent="form.post(route('permissions.store', { currentDept: $page.props.currentDept }))">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <InputLabel for="name" value="Name" />
                                    <TextInput
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="name"
                                    />
                                    <InputError :message="form.errors.name" class="mt-2" />
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <InputLabel for="scope" value="Scope" />
                                    <TextInput
                                        id="scope"
                                        v-model="form.scope"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="scope"
                                    />
                                    <InputError :message="form.errors.scope" class="mt-2" />
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <InputLabel for="slug" value="Slug" />
                                    <TextInput
                                        id="slug"
                                        v-model="form.slug"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="name"
                                    />
                                    <InputError :message="form.errors.slug" class="mt-2" />
                                </div>
                            </div>

                            <PrimaryButton class="mt-4">Save</PrimaryButton>

                        </form>

                </div>
            </div>
            </div>

        </div>
    </AppLayout>
</template>
