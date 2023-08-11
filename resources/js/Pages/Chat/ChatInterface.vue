<template>
    <div class="flex flex-col bg-white h-[calc(100vh-65px)]">
        <ChatHeader :user="user" />
        <div class="flex flex-col grow justify-between overflow-y-scroll">
            <!-- chat messages -->
            <ul class="flex flex-col px-4 py-4">
                <li v-for="message in [...Array(10).keys()]">
                    <!-- chat message -->
                    <div class="flex justify-start items-center mb-6">
                        <div class="flex-1 bg-indigo-400 text-white p-2 rounded-lg relative max-w-xl">
                            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                            <!-- arrow -->
                            <div class="absolute left-0 top-1/2 transform -translate-x-1/2 rotate-45 w-2 h-2 bg-indigo-400"></div>
                            <!-- end arrow -->
                        </div>
                    </div>
                    <!-- end chat message -->

                    <!-- chat message -->

                    <div class="flex justify-end items-center mb-6">
                        <div class="flex-1 bg-indigo-100 text-gray-800 p-2 rounded-lg relative max-w-xl">
                            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit.</div>

                            <!-- arrow -->
                            <div class="absolute right-0 top-1/2 transform translate-x-1/2 rotate-45 w-2 h-2 bg-indigo-100"></div>
                            <!-- end arrow -->
                        </div>
                    </div>
                    <!-- end chat message -->
                </li>
            </ul>
        </div>
        <ChatInput/>
    </div>
</template>

<script setup>
import ChatHeader from '@/Pages/Chat/ChatHeader.vue';
import ChatInput from '@/Pages/Chat/ChatInput.vue';

const { user } = defineProps({
    user: Object
});

</script>
