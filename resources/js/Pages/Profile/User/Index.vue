<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <UserInfo :user="user"/>
    </AuthenticatedLayout>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UserInfo from '@/Pages/Profile/User/UserInfo.vue';

const { user } = defineProps({
    user: Object
});

</script>

<style scoped>

</style>
