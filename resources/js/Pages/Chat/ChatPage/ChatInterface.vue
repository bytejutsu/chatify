<template>
    <div class="shadow-lg">
        <div class="flex flex-col bg-white h-full rounded-md">
            <ChatHeader :user="user" />
            <div ref="scrollContainer" class="flex flex-col grow justify-between overflow-y-auto scroll-smooth overflow-x-clip">
                <!-- chat messages -->
                <ul class="flex flex-col px-4 py-4">
                    <li v-for="(message, index) in messages" :key="index" class="">
                        <div v-if="index % 2 === 0">
                            <!-- chat message left-->
                            <div class="flex justify-start items-center mb-6">
                                <div class="flex-1 relative">
                                    <div class="bg-indigo-400 text-white break-words p-2 rounded-lg w-fit max-w-md shadow-lg">{{message}}</div>
                                    <!-- arrow -->
                                    <div class="absolute left-0 top-1/2 transform -translate-x-1/2 rotate-45 w-2 h-2 bg-indigo-400 shadow-lg"></div>
                                    <!-- end arrow -->
                                </div>
                            </div>
                            <!-- end chat message left-->
                        </div>
                        <div v-else>
                            <!-- chat message right-->
                            <div class="flex justify-end items-center mb-6 max-w-full">
                                <div class="flex relative">
                                    <div class="bg-indigo-100 text-gray-800 break-words p-2 rounded-lg w-fit max-w-md shadow-lg">{{message}}</div>
                                    <!-- arrow -->
                                    <div class="absolute right-0 top-1/2 transform translate-x-1/2 rotate-45 w-2 h-2 bg-indigo-100 shadow-lg"></div>
                                    <!-- end arrow -->
                                </div>
                            </div>
                            <!-- end chat message right-->
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
import { ref, nextTick, onMounted } from 'vue';
import { router } from '@inertiajs/vue3'

const { user } = defineProps({
    user: Object
});

const messages = ref(Array.from({ length: 7 }, (_, index) => `Message ${index}`));
const scrollContainer = ref(null);
const inputMessage = ref('');

const scrollToBottom = () => {
    nextTick(() => {
        if (scrollContainer.value) {
            scrollContainer.value.scrollTop = scrollContainer.value.scrollHeight;
        }
    });
};

/*
const sendMessage = () => {
    if (inputMessage.value.trim() !== '') {
        messages.value.push(inputMessage.value);
        inputMessage.value = ''; // Clear the input
        scrollToBottom();
    }
};
*/

/*
function sendMessage() {
    if (inputMessage.value.trim() !== '') {
        router.post(
            '/chat/1',
            { message: inputMessage.value },
            {
                onSuccess: page => {
                        inputMessage.value = ''; // Clear the input
                        scrollToBottom();
                    },
                onError: errors => { errors.forEach(error => console.error(error));}
            }
        );
    }
}
*/

function sendMessage() {
    if (inputMessage.value.trim() !== '') {
        window.axios.post('/chat/1', { message: inputMessage.value })
            .then((response) => {
                inputMessage.value = ''; // Clear the input
                scrollToBottom();
                console.log(response);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
}


onMounted(() => {
    scrollToBottom();

    window.Echo.channel(`chat.${1}`)
        .listen('MessageSent', (e) => {
            //this.messages.push(e.message);
            console.log(e);
            messages.value.push(e.message);
            scrollToBottom();
        });
});

// onMounted(scrollToBottom);

</script>