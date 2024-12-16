<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';

</script>

<script>
    export default {
        props: ['department','department_profiles','departments'],

        data() {
            return {
                form: useForm({
                    name: this.department.name,
                    abbreviation: this.department.abbreviation,
                    department_profile_id:  this.department.department_profile_id,
                    primary_identifier: this.department.primary_identifier,
                    secondary_identifier: this.department.secondary_identifier,
                    parent_id:  this.department.parent_id ?? '0',
                }),
            }
        },

        methods: {
        }
    }
</script>
<template>
    <AppLayout title="Edit Department">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Department '{{ department.name }}'
            </h2>
        </template>

        <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-4">

                        <form @submit.prevent="form.patch(route('departments.update', this.department))">
                            {{form}}
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
                                    <InputLabel for="abbreviation" value="Abbreviation" />
                                    <TextInput
                                        id="abbreviation"
                                        v-model="form.abbreviation"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="abbreviation"
                                    />
                                    <InputError :message="form.errors.abbreviation" class="mt-2" />
                                </div>
                            </div>

                            <div class="mt-12 grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <InputLabel for="primary_identifier" value="Primary Identifier" />
                                    <TextInput
                                        id="primary_identifier"
                                        v-model="form.primary_identifier"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="abbreviation"
                                    />
                                    <InputError :message="form.errors.abbreviation" class="mt-2" />
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <InputLabel for="secondary_identifier" value="Secondary Identifier" />
                                    <TextInput
                                        id="secondary_identifier"
                                        v-model="form.secondary_identifier"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="secondary_identifier"
                                    />
                                    <InputError :message="form.errors.secondary_identifier" class="mt-2" />
                                </div>
                            </div>





                            <div class="mt-12 grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <InputLabel for="department_profile_id" value="Assigned Department Profile" />
                                    <SelectInput
                                        id="department_profile_id"
                                        v-model="form.department_profile_id"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="name"
                                    >
                                        <option value="0">Select a Profile...</option>
                                        <option v-for="department_profile in department_profiles" :value="department_profile.id">{{ department_profile.name }}</option>
                                    </SelectInput>
                                    <InputError :message="form.errors.department_profile_id" class="mt-2" />
                                </div>
                            </div>
                            <div class="mt-4 grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <InputLabel for="parent_id" value="Parent Department" />
                                    <SelectInput
                                        id="parent_id"
                                        v-model="form.parent_id"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="name"
                                    >
                                        <option value="0">Select a Department...</option>
                                        <option v-for="department in departments" :value="department.id">{{ department.name }}</option>
                                    </SelectInput>
                                    <InputError :message="form.errors.parent_id" class="mt-2" />
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
