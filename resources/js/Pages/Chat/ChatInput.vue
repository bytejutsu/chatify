<template>
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
            <button class="inline-flex hover:bg-indigo-50 rounded-full p-2" type="button">
                <i class="fa-regular fa-paper-plane fa-lg"></i>
            </button>
        </div>
        <!-- end chat send action -->
    </div>
</template>

<script>

</script>

<style scoped>

</style>
