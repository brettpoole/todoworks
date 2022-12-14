<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { reactive } from '@vue/reactivity';
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';


const props = defineProps(['todos'])

const ui = reactive({
  showForm: false
});

const form = useForm({
    title: '',
    description: '',
    completed_at: null,
});

const submit = () => {
    form.post(route('todos.store'), {
        preserveScroll: true,
        onFinish: () => {
            form.reset();
            ui.showForm = false;
            console.log(ui.showForm);
            Inertia.reload({ only: ['todos'] });
        }
    });
};

const completeTask = (todoId) => {
    form.post(route('todos.complete', todoId), {
        preserveScroll: true,
        onFinish: () => {
            Inertia.reload({ only: ['todos'] });
        }
    });
};

const create = () => {
    ui.showForm = !ui.showForm;
    console.log(ui.showForm);
};
</script>

<template>
    <div v-if="ui.showForm" class="absolute opacity-75 min-h-full h-full min-w-full bg-gray-600 z-10"></div>
    <Head title="Todos" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between w-full">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Todos
                </h2>
                <primary-button @click="create()" class="bg-green-600">Add Todo</primary-button>
            </div>
        </template>

        <div class="py-12 absolute top-1/4 inset-0 z-20" v-if="ui.showForm">
            <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-gray-100">
                    <form @submit.prevent="submit">
                        <div class="p-2">
                            <div>
                                <input id="title" type="text" placeholder="Title" class="text-xl mt-1 block w-full border-0 p-3" v-model="form.title" required autofocus />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div>
                                <textarea id="description" type="text" placeholder="Description" class="mt-1 block border-0 w-full" v-model="form.description"></textarea>
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-1 p-2 border-t-2 border-gray-200">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Create
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-bind:key="todo.id" v-for="todo in todos" class="p-6 bg-white border-b border-gray-200">
                        <input @click="completeTask(todo.id)" type="checkbox" class="checked:bg-blue-500 border rounded mr-3" />
                        {{ todo.title }} <span v-if="todo.description">- {{ todo.description }}</span>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
textarea:focus, input:focus, textarea:focus-visible, input:focus-visible {
    outline: none !important;
    transition: 0.4s ease-out;
}
*:focus {
    outline: none !important;
    transition: 0.4s ease-out;
}

</style>
