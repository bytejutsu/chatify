<template>
    <div>
        <ul>
            <li v-for="user in users" :key="user.id">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex p-4 space-x-8 items-center">
                        <div class="flex flex-col justify-start items-center">
                            <img class="w-16 h-16 rounded-full object-cover" alt="User Avatar" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png" >
                        </div>
                        <div class="flex flex-col justify-start space-y-4">
                            <h3 class="text-xl font-bold text-gray-800">{{user.name}}</h3>
                            <p class="text-gray-600 text-sm">{{user.email}}</p>
                        </div>
                        <!--
                        <div class="p-6 text-gray-900">
                            {{user}} <span v-if="user.isOnline">Online</span>
                        </div>
                        -->
                        <span class="h-6 bg-green-100 text-green-800 text-xs rounded-full text-base p-2">available</span>
                        <i class="fa-solid fa-comment fa-xl"></i>
                        <i class="fa-solid fa-arrow-right fa-xl"></i>
                    </div>
                </div>
            </li>
        </ul>
    </div>



</template>

<script setup>

let props = defineProps({
    users: Object
});
</script>
