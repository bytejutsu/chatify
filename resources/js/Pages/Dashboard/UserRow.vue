<template>
    <tr class="bg-transparent">
        <td class="px-2 py-4 bg-white rounded-l-lg shadow-left shadow-bottom" colspan="1">
            <div class="flex justify-center items-center">
                <div class="h-16 w-16 flex-shrink-0">
                    <img class="w-16 h-16 rounded-full object-cover" alt="User Avatar" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2ZExAhgvkbtEYLbIBjydf2sHcSBdYTM29eeq1aT-vzxhdWTLtg0VgjUpmxXFW0Y8Wik&usqp=CAU">
                </div>
            </div>
        </td>
        <td class="px-2 py-4 bg-white shadow-bottom" colspan="6">
            <div class="flex flex-col">
                <h3 class="text-xl font-bold text-gray-800">{{ user.name }}</h3>
                <p class="text-gray-600 text-sm">{{ user.email }}</p>
            </div>
        </td>
        <td class="px-2 py-4 bg-white shadow-bottom" colspan="3">
            <div class="flex justify-center items-center">
                <span
                    class="px-2 py-1 rounded-full font-semibold"
                    :class="{ 'bg-green-300 text-white': status === true, 'bg-red-300 text-white': status === false }"
                >
                    {{ status === true ? 'Online' : 'Offline' }}
                </span>
            </div>
        </td>
        <td class="px-2 py-4 bg-white shadow-bottom" colspan="1">
            <Link href="/chat/start" method="post" as="button" :data="{ userB_id: user.id }"><i class="fa-solid fa-comment fa-xl"></i></Link>
        </td>
        <td class="px-2 py-4 bg-white rounded-r-lg shadow-right shadow-bottom" colspan="1">
            <Link :href="route('user.show', user.id)"><i class="fa-solid fa-arrow-right fa-xl"></i></Link>
        </td>
    </tr>
</template>

<script setup>

import {onBeforeUnmount, onMounted, ref} from 'vue';
import { Link } from '@inertiajs/vue3'

const { user } = defineProps({
    user: Object
});

const status = ref(user.is_online === 1);

onMounted(() => {

    //console.log(`user ${user.name} status is: `);
    //console.log(status.value);

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
.shadow-left {
    box-shadow: -5px 0 5px -5px rgba(0, 0, 0, 0.1);
}

.shadow-right {
    box-shadow: 5px 0 5px -5px rgba(0, 0, 0, 0.1);
}

.shadow-top {
    box-shadow: 0 -5px 5px -5px rgba(0, 0, 0, 0.1);
}

.shadow-bottom {
    box-shadow: 0 5px 5px -5px rgba(0, 0, 0, 0.1);
}
</style>
