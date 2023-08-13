<template>
    <div class="mx-auto max-w-screen-lg px-4 py-8 sm:px-8">
        <div class="overflow-y-hidden rounded-lg border">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="invisible">
                    <tr class="bg-black text-left text-xs font-semibold uppercase tracking-widest text-white">
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
                        <tr v-for="chat in [...Array(10).keys()]" class="text-gray-500 text-sm bg-white border-b border-gray-200">
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
                                    <p class="whitespace-no-wrap">lorem ipsum message dolum asem</p>
                                </div>
                            </td>
                            <td class="p-2 m-2" colspan="2">
                                <div class="flex flex-col justify-between items-center">
                                    <p class="whitespace-no-wrap text-xs">Aug 13, 2023</p>
                                    <div class="py-1"></div>
                                    <div class="flex">
                                        <span class="w-4 h-4 rounded-full bg-red-400 text-center text-xs text-white font-bold">1</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ChatList"
}
</script>

<style scoped>

</style>
