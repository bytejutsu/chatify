<template>
    <tr @click="goToChat" class="text-gray-500 text-sm bg-white border-b border-gray-200 cursor-pointer">
        <td class="p-2 m-2" colspan="1">
            <div class="flex justify-center items-center">
                <div class="h-14 w-14 flex-shrink-0">
                    <img class="h-full w-full rounded-full" alt="User Avatar" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2ZExAhgvkbtEYLbIBjydf2sHcSBdYTM29eeq1aT-vzxhdWTLtg0VgjUpmxXFW0Y8Wik&usqp=CAU" />
                </div>
            </div>
        </td>
        <td class="p-2 m-2" colspan="7">
            <div class="flex flex-col justify-center items-start">
                <div class="">
                    <p class="whitespace-no-wrap text-base text-black font-bold">{{ localChat.correspondent?.name}}</p>
                </div>
                <p class="whitespace-no-wrap">{{localChat.latest_message?.content}}</p>
            </div>
        </td>
        <td class="p-2 m-2" colspan="2">
            <div class="flex flex-col justify-between items-center">
                <p class="whitespace-no-wrap text-xs">{{ latestMessageFriendlyTimestamp }}</p>
                <div class="py-1"></div>
                <div class="flex">
                    <span v-if="localChat.unread_count > 0" class="w-4 h-4 rounded-full bg-red-400 text-center text-xs text-white font-bold">{{chat.unread_count}}</span>
                </div>
            </div>
        </td>
    </tr>
</template>

<script setup>
import moment from 'moment';
import {onMounted, ref, computed, onBeforeUnmount} from "vue";
import {router} from "@inertiajs/vue3";

const { chat } = defineProps({
    chat: Object,
});

const localChat = ref(chat);

//todo: investigate the cause of cannot read property of undefined and how to solve it other than with using ?.

const latestMessageTimestamp = ref(localChat.latest_message?.created_at);

const formatTimestamp = (timestamp) => {
    const now = moment();
    const timeSent = moment(timestamp);
    const diffDays = now.diff(timeSent, 'days');

    if (diffDays === 0) {
        return timeSent.format('HH:mm'); // e.g., 16:30
    } else if (diffDays === 1) {
        return 'Yesterday';
    } else if (diffDays < 7) {
        return timeSent.format('dddd'); // e.g., Monday
    } else {
        return timeSent.format('DD/MM/YYYY'); // e.g., 15/08/2023
    }
}

const latestMessageFriendlyTimestamp = computed(() => formatTimestamp(latestMessageTimestamp.value));

const goToChat = () => {
    router.get(`/chat/${chat.id}`);
};

onMounted(() => {
    //console.log("Chat Row Mounted");
    //console.log(chat);

    // Listen for the MessageSent event on the chat's private channel
    window.Echo.private(`chat.${chat.id}`)
        .listen('MessageSent', (e) => {
            // Update the chat data with the new message
            localChat.value.latest_message = e.message;
            localChat.value.correspondent = e.correspondent;

            //update the latest message timestamp in real-time
            latestMessageTimestamp.value = localChat.value.latest_message.created_at;

            // If the message sender is the correspondent, increment the unread count
            if (e.message.sender_id === chat.correspondent.id) {
                localChat.value.unread_count += 1;
            }
        });
});

onBeforeUnmount(() => {
    window.Echo.leave(`chat.${chat.id}`);
});

</script>

<style scoped>

</style>
