<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg max-w-4xl">
        <div class="flex flex-row justify-between p-4 space-x-8 items-center">
            <div class="flex flex-row justify-start">
                <div class="flex flex-col justify-start items-center">
                    <img class="w-16 h-16 rounded-full object-cover" alt="User Avatar" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png" >
                </div>
                <div class="flex flex-col justify-start space-y-4">
                    <h3 class="text-xl font-bold text-gray-800">{{user.name}}</h3>
                    <p class="text-gray-600 text-sm">{{user.email}}</p>
                </div>
            </div>
            <!--
            <div class="p-6 text-gray-900">
                {{user}} <span v-if="user.isOnline">Online</span>
            </div>
            -->
            <!--<span class="h-6 bg-green-100 text-green-800 text-xs rounded-full p-2">online</span>-->
            <!--<span class="h-6 bg-red-100 text-red-800 text-xs rounded-full p-2">offline</span>-->
            {{ status }}
            <i class="fa-solid fa-comment fa-xl"></i>
            <i class="fa-solid fa-arrow-right fa-xl"></i>
        </div>
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
            // Update the user's status based on the event data
            // e.user and e.status contain the user and status information
            //console.log(e);
            //status.value = e.status;
            status.value = e.status;
            console.log(status);
        });

});

</script>

<style scoped>

</style>
