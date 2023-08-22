<template>
    <Head title="Chat" />

    <AuthenticatedLayout class="max-h-screen">
        <div class="py-2 h-[calc(100vh-66px)]">
            <ChatInterface :chat="chat" class="h-full"/>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChatInterface from '@/Pages/Chat/ChatPage/ChatInterface.vue';

import {ref, onMounted, provide} from 'vue';

// Define the props that are passed to the component
const { chat, previous_url } = defineProps({
    chat: Object,
    previous_url: String
});

provide('previous_url', previous_url);

</script>

<style scoped>

</style>
