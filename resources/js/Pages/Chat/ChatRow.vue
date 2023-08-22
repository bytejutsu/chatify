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
                    <p class="whitespace-no-wrap text-base text-black font-bold">{{ processedChat.correspondent.name }}</p>
                </div>
                <p class="whitespace-no-wrap">{{ processedChat.latest_message.content }}</p>
            </div>
        </td>
        <td class="p-2 m-2" colspan="2">
            <div class="flex flex-col justify-between items-center">
                <p class="whitespace-no-wrap text-xs">{{ formatTimestamp(processedChat.latest_message.created_at) }}</p>
                <div class="py-1"></div>
                <div class="flex">
                    <div v-if="processedChat.unread_count > 0" class="w-4 h-4 rounded-full bg-red-400 flex items-center justify-center">
                        <span class="text-[8px] text-white font-bold">
                            {{ chatData.unread_count > 99 ? '+99' : chatData.unread_count }}
                        </span>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</template>

<script setup>
import moment from 'moment';
import {onMounted, ref, computed, onBeforeUnmount, watchEffect} from "vue";
import {router} from "@inertiajs/vue3";

const { chatData, userId } = defineProps({
    chatData: Object,
    userId: Number
});

// Processed chat data ref
const processedChat = ref({});

// Method to process chat data
const processChatData = (chat) => {
    if (chat.user1_id === userId) {
        chat.correspondent = chat.user2;
        chat.unread_count = chat.user1_unread_count;
    } else {
        chat.correspondent = chat.user1;
        chat.unread_count = chat.user2_unread_count;
    }

    //chat.modifiedFrom = 'client process chat data';

    return chat;
}

// Call the method and store the result in processedChat ref

watchEffect(() => {
    processedChat.value = processChatData(chatData);
});


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

const goToChat = () => {
    router.get(`/chat/${chatData['id']}`);
};


onMounted(() => {

//console.log(`processed chat`);
//console.log(processedChat.value);


//console.log("Chat Row Mounted");
//console.log(chat);

});


</script>

<style scoped>

</style>
