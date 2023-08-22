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
            <div class="m-2">
                <div class="flex">
                    <span v-if="unread_count > 0" class="w-4 h-4 rounded-full bg-red-400 text-center text-xs text-white font-bold">{{ unread_count }}</span>
                </div>
            </div>
        </div>
        <!-- end user info -->

        <!-- chat box action -->
        <div>
            <Link :href="previous_url" class="inline-flex hover:bg-indigo-50 rounded-full px-2 py-4" as="button" type="button">
                <i class="fa-solid fa-xmark fa-xl"></i>
            </Link>
        </div>
        <!-- end chat box action -->
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import {inject, onBeforeUnmount, onMounted, ref} from 'vue';

const { user, unread_count } = defineProps({
    user: Object,
    unread_count: Number,
});

const previous_url = inject('previous_url');

const status = ref(user.is_online === 1)

onMounted(() => {

    window.Echo.private(`user-status.${user.id}`)
        .listen('UserStatusChanged', (e) => {
            status.value = !!e.status;
        });

});

onBeforeUnmount(() => {
    window.Echo.leave(`user-status.${user.id}`);
});

</script>

<style scoped>

</style>
