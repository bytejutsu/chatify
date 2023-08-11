<template>
    <div class="flex items-center justify-between border-b p-2">
        <!-- user info -->
        <div class="flex items-center">
            <img class="rounded-full w-10 h-10"
                 src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" />
            <div class="pl-2">
                <div class="font-semibold">
                    <a class="hover:underline" href="#">John Doe</a>
                </div>
                <div class="text-xs text-gray-600">Online</div>
            </div>
        </div>
        <!-- end user info -->

        <!-- chat box action -->
        <div>
            <button class="inline-flex hover:bg-indigo-50 rounded-full p-2" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- end chat box action -->
    </div>
</template>

<script>

</script>

<style scoped>

</style>
