<template>
    <div class="hidden sm:block">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col mt-2">
                <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-3 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                &nbsp;
                            </th>
                            <th class="px-3 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-3 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Message
                            </th>
                            <th class="px-3 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Open
                            </th>
                            <th class="px-3 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Archive
                            </th>
                            <th class="px-3 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date / Time
                            </th>
                        </tr>
                        </thead>
                        <tbody v-if="messages" class="bg-white divide-y divide-gray-200">
                                <message v-for="(message,key) in messages.data" :key="key" :message="message"></message>
                        </tbody>
                        <tbody v-else class="bg-white divide-y divide-gray-200">
                            <tr class="bg-white">
                                <td colspan="6" class="max-w-0 px-3 py-4 text-center italic whitespace-nowrap text-sm text-gray-900">
                                    No Messages
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <paginator @page-change="fetchData" :items="messages"></paginator>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['messages'],
    methods: {
        fetchData(page) {
            this.$store.dispatch('messages/GET_PAGINATED_MESSAGES', page);
        }
    }
}
</script>
