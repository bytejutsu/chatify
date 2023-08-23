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
                        <ChatRow v-for="(chat, index) in state.chatsArray" :chat="chat" :userId="userId" :key="getObjectHash(chat)"/>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import ChatRow from "@/Pages/Chat/ChatRow.vue";
import {onBeforeUnmount, onMounted, reactive, ref} from "vue";

const { chats, userId } = defineProps({
    chats: Array,
    userId: Number
});

const state = reactive({
    chatsArray: chats
});

onMounted(() => {

    //console.log('chatsArray:')
    //console.log(chatsArray);

    window.Echo.private(`chat-list.${userId}`)
        .listen('ChatUpdated', (e) => {
            console.log('event received on chat list');

            console.log(`new chatupdated event:`);
            console.log(e);

            pushChatToTop(e.chat);
        });
});


onBeforeUnmount(() => {
    window.Echo.leave(`chat-list.${userId}`);
});


const pushChatToTop = (chat) => {

    const index = state.chatsArray.findIndex(c => c.id === chat.id);

    if (index !== -1) {
        state.chatsArray.splice(index, 1);
    }

    state.chatsArray.unshift(chat);
}

function getObjectHash(obj) {
    return JSON.stringify(obj);
}

</script>

<style scoped>

</style>
