<template>
    <div class="flex-1 overflow-auto focus:outline-none" tabindex="0">
        <action-bar></action-bar>
        <main class="flex-1 relative pb-8 z-0 overflow-y-auto">
            <page-header></page-header>
            <div class="mt-8">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-lg leading-6 font-medium text-gray-900">Overview</h2>
                    <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Card -->
                        <balance-card></balance-card>
                    </div>
                </div>

                <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                    Recent activity
                </h2>

                <activity-list-small></activity-list-small>
                <activity-list></activity-list>
                <button @click="call('0400588588')" type="button"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                    0400588588
                </button>

            </div>
        </main>
    </div>
</template>
<script>
export default {
    methods: {
        call(number) {
            axios.post('/api/click-to-call', {number});
        }
    }
}
</script>
