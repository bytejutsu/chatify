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
                        <ChatRow v-for="chat in chatsArray" :chat="chat" :key="chat.id"/>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import ChatRow from "@/Pages/Chat/ChatRow.vue";
import {onBeforeUnmount, onMounted, ref} from "vue";


const { chats, userId } = defineProps({
    chats: Array,
    userId: Number
});

const chatsArray = ref(chats);

onMounted(() => {
    window.Echo.private(`chat-list.${userId}`)
        .listen('ChatUpdated', (e) => {
            console.log('event received on chat list');

            console.log(`new chat: ${e.chat}`);

            pushChatToTop(chatsArray.value, e.chat);

        });
});


onBeforeUnmount(() => {
    window.Echo.leave(`chat-list.${userId}`);
});


const pushChatToTop = (chats, selectedChat) => {
    const index = chats.findIndex(c => c.id === selectedChat.id);

    if (index !== -1) {
        chats.splice(index, 1);
    }

    chats.unshift(selectedChat);

    chatsArray.value = [...chats];

    console.table(chatsArray.value);
}


</script>

<style scoped>

</style>
