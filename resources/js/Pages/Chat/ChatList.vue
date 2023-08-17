<template>
    <div class="mx-auto max-w-screen-lg px-4 py-8 sm:px-8">
        <div class="overflow-y-hidden rounded-lg border">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="invisible">
                    <tr class="bg-black text-center text-xs font-semibold uppercase tracking-widest text-white">
                        <th class="px-5 py-3" colspan="1">x</th>
                        <th class="px-5 py-3" colspan="1">x</th>
                        <th class="px-5 py-3" colspan="1">x</th>
                        <th class="px-5 py-3" colspan="1">x</th>
                        <th class="px-5 py-3" colspan="1">x</th>
                        <th class="px-5 py-3" colspan="1">x</th>
                        <th class="px-5 py-3" colspan="1">x</th>
                        <th class="px-5 py-3" colspan="1">x</th>
                        <th class="px-5 py-3" colspan="1">x</th>
                        <th class="px-5 py-3" colspan="1">x</th>
                    </tr>
                    </thead>
                    <tbody class="">
                        <ChatRow v-for="chat in chats" :chat="chat"/>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import ChatRow from "@/Pages/Chat/ChatRow.vue";

const { chats } = defineProps({
    chats: Array,
});

</script>

<style scoped>

</style>
