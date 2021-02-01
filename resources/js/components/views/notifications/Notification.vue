<template>
    <tr class="bg-white">
        <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            <div class="flex">
                <a href="#" class="group items-center inline-flex space-x-2 truncate text-sm">
                    <i class="fas fa-envelope text-gray-500 hover:text-gray-900"></i>
                    <p class="text-gray-500 truncate group-hover:text-gray-900" v-html="messageText" />
                </a>
            </div>
        </td>
        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500" v-text="notificationDate" />
        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
            <a href="#" @click="markAsRead()"
               class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <icon name="eye" />
            </a>
        </td>
    </tr>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    props: ['notification'],
    methods: {
        ...mapActions('notifications', ['MARK_AS_READ']),
        markAsRead() {
            console.log('Marking notification as read: ' + this.notification.id);
            console.log('Notification Data: ' + this.notification.data);
            this.MARK_AS_READ(this.notification.id);

        }
    },
    computed: {
        ...mapGetters('users', ['users']),
        notificationDate() {
            return this.$moment.utc(this.notification.created_at).local().fromNow();
        },
        messageText() {
            switch (this.notification.type) {
                case "App\\Notifications\\MessageReceivedNotification":
                    return `Message from  ` +
                        this.notification.data.fromUser +
                        ` <a href="/messages/` +
                        this.notification.data.id +
                        `" class="font-bold text-blue-500 hover:underline">[Message ID# ` +
                        this.notification.data.id + `]</a>`;

            }
        }
    }

}
</script>

<style scoped>

</style>
