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

import { ref, onMounted } from 'vue';

const { chat } = defineProps({
    chat: Object,
});

</script>

<style scoped>

</style>
