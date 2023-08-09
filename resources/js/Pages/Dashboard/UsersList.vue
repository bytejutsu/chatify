<template>
    <div>
        <ul>
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
