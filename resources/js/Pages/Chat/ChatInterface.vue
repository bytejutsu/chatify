<template>
    <div class="flex flex-col bg-white h-[calc(100vh-65px)]">
        <ChatHeader :user="user" />
        <div ref="scrollContainer" class="flex flex-col grow justify-between overflow-y-auto scroll-smooth">
            <!-- chat messages -->
            <ul class="flex flex-col px-4 py-4">
                <li v-for="(message, index) in messages" :key="index" >
                    <div v-if="index % 2 === 0">
                        <!-- chat message left-->
                        <div class="flex justify-start items-center mb-6">
                            <div class="flex-1 relative max-w-xl">
                                <div class="bg-indigo-400 text-white p-2 rounded-lg w-fit">{{message}}</div>
                                <!-- arrow -->
                                <div class="absolute left-0 top-1/2 transform -translate-x-1/2 rotate-45 w-2 h-2 bg-indigo-400"></div>
                                <!-- end arrow -->
                            </div>
                        </div>
                        <!-- end chat message left-->
                    </div>
                    <div v-else>
                        <!-- chat message right-->
                        <div class="flex justify-end items-center mb-6">
                            <div class="flex relative max-w-xl">
                                <div class="bg-indigo-100 text-gray-800 p-2 rounded-lg w-fit">{{message}}</div>
                                <!-- arrow -->
                                <div class="absolute right-0 top-1/2 transform translate-x-1/2 rotate-45 w-2 h-2 bg-indigo-100"></div>
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
                <button class="inline-flex hover:bg-indigo-50 rounded-full p-2" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </button>
            </div>
            <!-- end chat input action -->

            <div class="w-full mx-2">
                <input class="w-full rounded-full border border-gray-200" type="text" value="" placeholder="Aa" autofocus />
            </div>

            <!-- chat send action -->
            <div>
                <button @click="addMessage" class="inline-flex hover:bg-indigo-50 rounded-full p-2" type="button">
                    <i class="fa-regular fa-paper-plane fa-lg"></i>
                </button>
            </div>
            <!-- end chat send action -->
        </div>
        <!-- End Chat Input-->
    </div>
</template>

<script setup>
import ChatHeader from '@/Pages/Chat/ChatHeader.vue';
import ChatInput from '@/Pages/Chat/ChatInput.vue';
import { ref, nextTick, onMounted } from 'vue';

const { user } = defineProps({
    user: Object
});

const messages = ref(Array.from({ length: 7 }, (_, index) => `Message ${index}`));
const scrollContainer = ref(null);

const scrollToBottom = () => {
    nextTick(() => {
        if (scrollContainer.value) {
            scrollContainer.value.scrollTop = scrollContainer.value.scrollHeight;
        }
    });
};

const addMessage = () => {
    messages.value.push(`Dummy Message ${messages.value.length + 1}`);
    scrollToBottom();
};

onMounted(scrollToBottom);

</script>
