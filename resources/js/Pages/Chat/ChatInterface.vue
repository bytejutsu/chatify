<template>
    <div class="flex flex-col justify-between">
        <!-- chat messages -->
        <ul class="flex flex-col px-4 py-4">
            <li v-for="message in [...Array(10).keys()]">
                <!-- chat message -->
                <div class="flex items-center mb-4">
                    <div class="flex-none flex flex-col items-center space-y-1 mr-4">
                        <img class="rounded-full w-10 h-10"
                             src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" />
                        <a href="#" class="block text-xs hover:underline">John Doe</a>
                    </div>
                    <div class="flex-1 bg-indigo-400 text-white p-2 rounded-lg mb-2 relative">
                        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>

                        <!-- arrow -->
                        <div class="absolute left-0 top-1/2 transform -translate-x-1/2 rotate-45 w-2 h-2 bg-indigo-400"></div>
                        <!-- end arrow -->
                    </div>
                </div>

                <!-- end chat message -->

                <!-- chat message -->

                <div class="flex items-center flex-row-reverse mb-4">
                    <div class="flex-none flex flex-col items-center space-y-1 ml-4">
                        <img class="rounded-full w-10 h-10"
                             src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" />
                        <a href="#" class="block text-xs hover:underline">Jesse</a>
                    </div>
                    <div class="flex-1 bg-indigo-100 text-gray-800 p-2 rounded-lg mb-2 relative">
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
</template>

<script setup>
import ChatHeader from '@/Pages/Chat/ChatHeader.vue';
</script>
