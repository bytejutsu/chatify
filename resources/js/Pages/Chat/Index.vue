<template>
    <Head title="Chats" />

    <AuthenticatedLayout>
        <div class="p-12">
            <div class="flex justify-center">
                <ChatList :chats="chats"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChatList from "@/Pages/Chat/ChatList.vue";

const { chats } = defineProps({
    chats: Array,
});

</script>

<style scoped>

</style>
