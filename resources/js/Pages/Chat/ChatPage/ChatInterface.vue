<template>
    <div class="shadow-lg">
        <div class="flex flex-col bg-white h-full rounded-md">
            <ChatHeader :user="chat.correspondent" :unread_count="unread_count"/>
            <div ref="scrollContainer" @scroll="checkScroll" class="flex flex-col-reverse grow justify-between overflow-y-auto overflow-x-clip">
                <!-- chat messages -->
                <ul class="flex flex-col px-4 py-4">
                    <li v-for="(message, index) in messages" :key="index" class="">
                        <div v-if="message.sender_id !== chat.correspondent.id">
                            <!-- chat message right-->
                            <div class="flex justify-end items-center mb-6 max-w-full">
                                <div class="flex relative">
                                    <div class="bg-indigo-100 text-gray-800 break-words p-2 rounded-lg w-fit max-w-md shadow-lg">{{message.content}}</div>
                                    <!-- arrow -->
                                    <div class="absolute right-0 top-1/2 transform translate-x-1/2 rotate-45 w-2 h-2 bg-indigo-100 shadow-lg"></div>
                                    <!-- end arrow -->
                                </div>
                            </div>
                            <!-- end chat message right-->
                        </div>
                        <div v-else>
                            <!-- chat message left-->
                            <div class="flex justify-start items-center mb-6">
                                <div class="flex-1 relative">
                                    <div class="bg-indigo-400 text-white break-words p-2 rounded-lg w-fit max-w-md shadow-lg">{{message.content}}</div>
                                    <!-- arrow -->
                                    <div class="absolute left-0 top-1/2 transform -translate-x-1/2 rotate-45 w-2 h-2 bg-indigo-400 shadow-lg"></div>
                                    <!-- end arrow -->
                                </div>
                            </div>
                            <!-- end chat message left-->
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Chat Input-->
            <div class="flex items-center border-t p-2">
                <!-- chat input action -->
                <div>
                    <button class="inline-flex hover:bg-indigo-50 rounded-full px-2 py-4" type="button">
                        <i class="fa-solid fa-plus fa-lg"></i>
                    </button>
                </div>
                <!-- end chat input action -->

                <div class="w-full mx-2">
                    <input type="text" v-model="inputMessage" @keyup.enter="sendMessage" placeholder="Aa" autofocus class="w-full rounded-full border border-gray-200" />
                </div>

                <!-- chat send action -->
                <div>
                    <button @click="sendMessage" class="inline-flex hover:bg-indigo-50 rounded-full px-2 py-4" type="button">
                        <i class="fa-regular fa-paper-plane fa-lg"></i>
                    </button>
                </div>
                <!-- end chat send action -->
            </div>
            <!-- End Chat Input-->
        </div>
    </div>
</template>

<script setup>
import ChatHeader from '@/Pages/Chat/ChatPage/ChatHeader.vue';
import ChatInput from '@/Pages/Chat/ChatPage/ChatInput.vue';
import {ref, nextTick, onMounted, onUnmounted, onBeforeUnmount} from 'vue';

const { chat } = defineProps({
    chat: Object,
});

const messages = ref(chat.messages);


const scrollContainer = ref(null);
const inputMessage = ref('');
const unread_count = ref(chat.unread_count);

const scrollToBottom = () => {
    nextTick(() => {
        scrollContainer.value.scrollTop = scrollContainer.value.scrollHeight;
    });
};


const checkScroll = () => {
    const { scrollTop } = scrollContainer.value;

    // With flex-col-reverse, check if scrollTop is 0 to determine if it's at the bottom
    const isAtBottom = scrollTop === 0;

    //console.log(`scrollTop: ${scrollTop}`);

    if (isAtBottom) {
        //console.log("The scroll container is at its bottom!");

        // User is at the bottom, mark messages as read
        axios.post(`/chat/${chat.id}/read`)
            .then(response => {
                unread_count.value = 0;  // Reset the local unread count
            });
    }

    return isAtBottom;
};


const clearInput = () => {
    inputMessage.value = ''; // Clear the input
};

const inputIsNotEmpty = () => {
    return inputMessage.value.trim() !== '';
};

function sendMessage() {
    if (inputIsNotEmpty()) {
        window.axios.post(`/chat/${chat.id}`, { message: {content: inputMessage.value, chat_id: chat.id} })
            .then((response) => {
                clearInput();
                scrollToBottom();
                //console.log(response);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
}

onMounted(() => {

    // call checkScroll to mark unread message as read since the scroll is at the bottom initially
    checkScroll();

    window.Echo.private(`chat.${chat.id}`)
        .listen('MessageSent', (e) => {
            // Check if the user is already at the bottom before the new message is received
            const wasAtBottom = checkScroll();

            //console.log(e);
            messages.value.push(e.message);

            //if sender is correspondent increment unread_count until chat is marked read

            if(e.message.sender_id === chat.correspondent.id){
                unread_count.value += 1;
                //console.log(`unread_count: ${unread_count.value}`);
            }

            //if the user is already at the bottom then an auto scroll will happen in case of receiving new messages
            if (wasAtBottom) {
                nextTick(() => {
                    scrollToBottom();
                });
            }

        });

});

onBeforeUnmount(() => {
    window.Echo.leave(`chat.${chat.id}`);
});

</script>
