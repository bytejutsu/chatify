<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!--
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        -->


        <div class="p-12">
            <div class="flex justify-center">
                <UsersList :users="users" />
            </div>
        </div>


    </AuthenticatedLayout>
</template>

<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import UsersList from "@/Pages/Dashboard/UsersList.vue";

let props = defineProps({
    users: Object
});

</script>
