<template>
    <Head title="Chat" />

    <AuthenticatedLayout class="max-h-screen">
        <div class="flex flex-col bg-white h-[calc(100vh-65px)]">
            <ChatHeader />
            <!--
            <div class="flex flex-col grow overflow-y-scroll">
                <span>hi</span>
                <span>ho</span>
                <span>ho</span>
                <span>ho</span>
                <span>ho</span>
            </div>
            -->
            <ChatInterface class="flex flex-col grow overflow-y-scroll"/>
            <ChatInput/>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChatInterface from '@/Pages/Chat/ChatInterface.vue';
import ChatHeader from '@/Pages/Chat/ChatHeader.vue';
import ChatInput from '@/Pages/Chat/ChatInput.vue';


import { ref, onMounted } from 'vue';

const { user } = defineProps({
    user: Object,
});

</script>

<style scoped>

</style>
