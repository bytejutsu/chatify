<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout class="">
        <!--
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        -->

        <div class="max-h-[600px] w-full overflow-y-auto">
            <UsersList :users="users"/>
        </div>

    </AuthenticatedLayout>

    <!--
    <AuthenticatedLayout class="max-h-screen">
        <div class="py-2 h-[calc(100vh-66px)]">
            <ChatInterface :chat="chat" :userId="userId" class="h-full"/>
        </div>
    </AuthenticatedLayout>
    -->

</template>

<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import UsersList from "@/Pages/Dashboard/UsersList.vue";

let props = defineProps({
    users: Object
});

</script>
