<template>
    <div>
        <ul class="space-y-4">
            <li v-for="user in users" :key="user.id">
                <UserCard :user="user"/>
            </li>
        </ul>
    </div>
</template>

<script setup>

import UserCard from "@/Pages/Dashboard/UserCard.vue";

let props = defineProps({
    users: Object
});

</script>
