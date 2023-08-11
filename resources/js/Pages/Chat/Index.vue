<template>
    <Head title="Chat" />

    <AuthenticatedLayout class="max-h-screen">
        <ChatInterface/>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChatInterface from '@/Pages/Chat/ChatInterface.vue';

import { ref, onMounted } from 'vue';

const { user } = defineProps({
    user: Object,
});

</script>

<style scoped>

</style>
