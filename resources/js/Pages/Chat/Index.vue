<template>
    <Head title="Chats" />

    <AuthenticatedLayout>
        <div class="p-12">
            <div class="flex justify-center">
                <ChatList :chats="chats" :userId="userId"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChatList from "@/Pages/Chat/ChatList.vue";

const { chats, userId } = defineProps({
    chats: Array,
    userId: Number
});

</script>

<style scoped>

</style>
