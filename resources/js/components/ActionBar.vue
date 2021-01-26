<template>
    <div class="relative flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:border-none">
        <sidebar-button @click="sidebarOpen = true"></sidebar-button>
        <!-- Search bar -->
        <div class="flex-1 px-4 flex justify-between sm:px-6 lg:max-w-6xl lg:mx-auto lg:px-8">
            <div class="flex-1 flex">
                <search-bar v-show="search" :placeholder="placeholder" :action="action"></search-bar>
            </div>
            <div class="ml-4 flex items-center md:ml-6">
                <notifications-button></notifications-button>
                <profile-dropdown></profile-dropdown>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ActionBar",
    props: ['search', 'placeholder', 'action'],
}
</script>

<style scoped>

</style>
