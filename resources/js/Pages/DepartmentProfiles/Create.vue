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
        props: ['permissions'],

        data() {
            return {
                form: useForm({
                    name: '',
                    all_permissions: '0',
                    permissions: [],
                }),
            }
        },

        methods: {
            checked: function(permission) {
                let index = this.form.permissions.indexOf(permission.id);

                if (index === -1) {
                    this.form.permissions.push(permission.id);
                } else {
                    this.form.permissions.splice(index, 1);
                }
            }
        }
    }
</script>
<template>
    <AppLayout title="Create Department Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create Department Profile
            </h2>
        </template>

        <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-4">

                        <form @submit.prevent="form.post(route('department_profiles.store', { currentDept: $page.props.currentDept }))">
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
                                    <InputLabel for="all_permissions" value="Has all Permissions?" />
                                    <SelectInput
                                        id="all_permissions"
                                        v-model="form.all_permissions"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="name"
                                    >
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </SelectInput>
                                    <InputError :message="form.errors.all_permissions" class="mt-2" />
                                </div>
                            </div>

                            <div v-if="form.all_permissions != 1" class="mb-4 font-bold mt-4 dark:text-gray-300">Delegated Permissions</div>

                            <div v-if="form.all_permissions != 1" class="ml-4 dark:text-gray-300 font-bold mb-4" v-for="set,scope in permissions">
                                <div>{{ scope }}</div>

                                <div v-for="permission in set" class="my-4 ml-4 flex items-center">
                                    <input :id="permission.id" @input="checked(permission)" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label :for="permission.id" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{permission.name}}</label>
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
