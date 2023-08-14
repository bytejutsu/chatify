<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg max-w-4xl">
        <div class="flex flex-row justify-between p-4 space-x-8 items-center">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <img class="w-16 h-16 rounded-full object-cover" alt="User Avatar" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2ZExAhgvkbtEYLbIBjydf2sHcSBdYTM29eeq1aT-vzxhdWTLtg0VgjUpmxXFW0Y8Wik&usqp=CAU">
                </div>
                <div class="flex flex-col w-[200px] max-w-[200px]">
                    <h3 class="text-xl font-bold text-gray-800">{{ user.name }}</h3>
                    <p class="text-gray-600 text-sm">{{ user.email }}</p>
                </div>
            </div>
            <span
                class="px-2 py-1 rounded-full font-semibold"
                :class="{ 'bg-green-300 text-white': status === 1, 'bg-red-300 text-white': status === 0 }"
            >
            {{ status === 1 ? 'Online' : 'Offline' }}
            </span>
            <!--<Link :href="route('chat.show', { user: user.id })"><i class="fa-solid fa-comment fa-xl"></i></Link>-->
            <Link href="/chat/start" method="post" :data="{ userB_id: user.id }"><i class="fa-solid fa-comment fa-xl"></i></Link>
            <i class="fa-solid fa-arrow-right fa-xl"></i>
        </div>
    </div>
</template>

<script setup>

import { onMounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3'

const { user } = defineProps({
    user: Object
});

const status = ref(user.is_online)

/*
const startChat = () => {
    window.axios.post('/chat/start', { userB_id: user.id })
        .then((response) => {
            console.log(response);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
};
*/

onMounted(() => {

    window.Echo.private(`user-status.${user.id}`)
        .listen('UserStatusChanged', (e) => {
            // Update the user's status based on the event data
            // e.user and e.status contain the user and status information
            //console.log(e);
            //status.value = e.status;
            status.value = e.status;
        });

});

</script>

<style scoped>

</style>
