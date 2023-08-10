<template>
    <Head title="Chat" />

    <AuthenticatedLayout>
        <div class="h-screen">
            <ChatHeader />
            <ChatInterface/>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChatInterface from '@/Pages/Chat/ChatInterface.vue';
import ChatHeader from '@/Pages/Chat/ChatHeader.vue';


import { ref, onMounted } from 'vue';

const { user } = defineProps({
    user: Object,
});

</script>

<style scoped>

</style>
