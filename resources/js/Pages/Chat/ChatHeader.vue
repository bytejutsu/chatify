<template>
    <div class="flex items-center justify-between border-b p-2">
        <!-- user info -->
        <div class="flex items-center">
            <img class="rounded-full w-10 h-10"
                 src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2ZExAhgvkbtEYLbIBjydf2sHcSBdYTM29eeq1aT-vzxhdWTLtg0VgjUpmxXFW0Y8Wik&usqp=CAU" />
            <div class="pl-2">
                <div class="font-semibold">
                    <a class="hover:underline" href="#">{{user.name}}</a>
                </div>
                <div class="text-xs text-gray-600">{{ status ? 'online' : 'offline' }}</div>
            </div>
        </div>
        <!-- end user info -->

        <!-- chat box action -->
        <div>
            <button class="inline-flex hover:bg-indigo-50 rounded-full p-2" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- end chat box action -->
    </div>
</template>

<script setup>

import { onMounted, ref } from 'vue';

const { user } = defineProps({
    user: Object
});

const status = ref(user.is_online)


onMounted(() => {

    window.Echo.private(`user-status.${user.id}`)
        .listen('UserStatusChanged', (e) => {
            status.value = e.status;
        });

});

</script>

<style scoped>

</style>
