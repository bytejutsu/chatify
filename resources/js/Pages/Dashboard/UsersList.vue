<template>
    <div class="flex w-full justify-center">
        <table class="border-separate border-spacing-y-4">
            <thead class="invisible">
            <tr class="bg-black text-center text-xs font-semibold uppercase tracking-widest text-white">
                <th v-for="item in [...Array(12).keys()]" class="px-3 py-3" colspan="1">x</th>
            </tr>
            </thead>
            <tbody class="">
                <UserRow v-for="user in users" :user="user" :key="user.id"/>
            </tbody>
        </table>
    </div>
</template>

<script setup>

import UserRow from "@/Pages/Dashboard/UserRow.vue";

let props = defineProps({
    users: Array
});

</script>
