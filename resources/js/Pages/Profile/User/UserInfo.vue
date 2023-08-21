<template>
    <div class="flex flex-col justify-center items-center bg-white rounded-lg space-y-4 m-4 p-4">
        <div class="flex justify-center items-center">
            <span
                class="px-2 py-1 rounded-full font-semibold"
                :class="{ 'bg-green-300 text-white': status === true, 'bg-red-300 text-white': status === false }"
            >
                {{ status === true ? 'Online' : 'Offline' }}
            </span>
        </div>
        <div class="flex justify-center items-center">
            <div class="h-20 w-20 flex-shrink-0">
                <img class="w-20 h-20 rounded-full object-cover" alt="User Avatar" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2ZExAhgvkbtEYLbIBjydf2sHcSBdYTM29eeq1aT-vzxhdWTLtg0VgjUpmxXFW0Y8Wik&usqp=CAU">
            </div>
        </div>
        <div class="flex flex-col justify-center items-center">
            <h3 class="text-xl font-bold text-gray-800">{{ user.name }}</h3>
            <p class="text-gray-600 text-sm">{{ user.email }}</p>
        </div>
    </div>
</template>

<script setup>

import {onBeforeUnmount, onMounted, ref} from 'vue';

const { user } = defineProps({
    user: Object
});

const status = ref(user.is_online === 1);

onMounted(() => {
    window.Echo.private(`user-status.${user.id}`)
        .listen('UserStatusChanged', (e) => {
            console.log(`user ${user.name} status: `);
            console.log(e);
            status.value = !!e.status;
        });

});

onBeforeUnmount(() => {
    window.Echo.leave(`user-status.${user.id}`);
});

</script>

<style scoped>

</style>
