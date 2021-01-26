<template>
    <div class="flex-1 overflow-auto focus:outline-none" tabindex="0">
        <action-bar></action-bar>
        <main class="flex-1 relative pb-8 z-0 overflow-y-auto">
            <page-header></page-header>
            <div class="mt-8">
                <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                    Unread Notifications
                </h2>
                    <unread-notifications-list></unread-notifications-list>
            </div>
        </main>
    </div>
</template>

<script>
export default {
  name: "Notifications"
}
</script>
