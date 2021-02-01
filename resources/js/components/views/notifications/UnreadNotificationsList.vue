<template>
    <div class="hidden sm:block">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col mt-2">
                <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Notification
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Seen?
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
<!--                        <tr class="bg-white">-->
<!--                            <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900">-->
<!--                                <div class="flex">-->
<!--                                    <a href="#" class="group items-center inline-flex space-x-2 truncate text-sm">-->
<!--                                        <i class="fas fa-money-bill-wave text-gray-500 hover:text-gray-900"></i>-->
<!--                                        <p class="text-gray-500 truncate group-hover:text-gray-900">-->
<!--                                            Payment from Molly Sanders <a href="/billing/customer/1001" class="font-bold text-blue-500 hover:underline">[Payment ID# PAY-1000]</a>-->
<!--                                        </p>-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                            </td>-->
<!--                            <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">-->
<!--                                July 11, 2020-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        <tr class="bg-white">-->
<!--                            <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900">-->
<!--                                <div class="flex">-->
<!--                                    <a href="#" class="group items-center inline-flex space-x-2 truncate text-sm">-->
<!--                                        <i class="fas fa-ticket-alt text-gray-500 hover:text-gray-900"></i>-->
<!--                                        <p class="text-gray-500 truncate group-hover:text-gray-900">-->
<!--                                            New Ticket from Stokes Wheeler <a href="/tickets/1005" class="font-bold text-blue-500 hover:underline">[Ticket ID# 1005]</a>-->
<!--                                        </p>-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                            </td>-->
<!--                            <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">-->
<!--                                July 11, 2020-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        <tr class="bg-white">-->
<!--                            <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900">-->
<!--                                <div class="flex">-->
<!--                                    <a href="#" class="group items-center inline-flex space-x-2 truncate text-sm">-->
<!--                                        <i class="fas fa-comment-dots text-gray-500 hover:text-gray-900"></i>-->
<!--                                        <p class="text-gray-500 truncate group-hover:text-gray-900">-->
<!--                                            Reply from Gaskin Contruction <a href="/tickets/1006" class="font-bold text-blue-500 hover:underline">[Ticket ID# 1006]</a>-->
<!--                                        </p>-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                            </td>-->
<!--                            <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">-->
<!--                                July 11, 2020-->
<!--                            </td>-->
<!--                        </tr>-->
                        <notification v-for="(notification,key) in groupedNotifications[page]" :key="key" :notification="notification"></notification>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <paginator :per-page="per_page" v-model="page" :total-records="totalRecords" :max-page="maxPage"></paginator>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { mapGetters } from 'vuex';

export default {
    data() {
        return {
                page: 0,
                per_page: 10
        }
    },
    methods: {

    },
    computed: {
        ...mapGetters('notifications', ['notifications']),
        totalRecords() {
            return this.notifications?.length
        },
        maxPage() {
            return this.groupedNotifications?.length;
        },
        groupedNotifications() {
            return _.chunk(this.notifications, this.per_page);
        },
    }
}
</script>

<style scoped>

</style>
