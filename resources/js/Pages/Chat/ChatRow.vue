<template>
    <tr class="text-gray-500 text-sm bg-white border-b border-gray-200">
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
                    <p class="whitespace-no-wrap text-base text-black font-bold">John Doe</p>
                </div>
                <p class="whitespace-no-wrap">{{chat.messages[chat.messages.length - 1].content}}</p>
            </div>
        </td>
        <td class="p-2 m-2" colspan="2">
            <div class="flex flex-col justify-between items-center">
                <p class="whitespace-no-wrap text-xs">{{ formatTimestamp(chat.messages[chat.messages.length - 1].updated_at)}}</p>
                <div class="py-1"></div>
                <div class="flex">
                    <span class="w-4 h-4 rounded-full bg-red-400 text-center text-xs text-white font-bold">{{chat.messages.length}}</span>
                </div>
            </div>
        </td>
    </tr>
</template>

<script setup>
import moment from 'moment';
import {onMounted} from "vue";

const { chat } = defineProps({
    chat: Object,
});

//todo: make formatTimestamp a computed property

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

onMounted(() => {
    console.log("Chat Row Mounted");
    console.log(chat);
    console.log(chat.latest_message);
    console.log(chat.user1);
    console.log(chat.user2);
});

</script>

<style scoped>

</style>
