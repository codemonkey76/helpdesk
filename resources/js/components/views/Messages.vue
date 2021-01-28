<template>
    <div class="flex-1 overflow-auto focus:outline-none" tabindex="0">
        <action-bar :search="true" placeholder="Search messages" :action="action"></action-bar>
        <main class="flex-1 relative pb-8 overflow-y-auto">
            <page-header @action="sendMessageDialog" :action-enabled="true" action-label="Send message"></page-header>
            <div class="mt-8">

                <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                    Messages
                </h2>
                <message-list></message-list>
                <message-create ref="createMessage"></message-create>
                <message-view ref="viewMessage"></message-view>

            </div>
        </main>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';

export default {
    data() {
        return {
            action: 'messages/SEARCH_MESSAGES'
        }
    },
    watch: {
        messages() {
            this.showMessage(this.$route);
        },
        $route(to, from) {
            this.showMessage(to);
        }
    },
    methods: {
        sendMessageDialog() {
            this.$refs.createMessage.show();
        },
        messageId(route) {
            if (route.params.hasOwnProperty('pathMatch')) return route.params.pathMatch.substring(1);
            return null;
        },
        showMessage(to) {
            if (!this.messages.length) return;

            let id = this.messageId(to);

            if (!id) return;

            let message = this.messages.find(x => x.id === parseInt(id));

            if (!message) {
                this.$toast.open({
                    message: 'Could not find message: ' + to.params.id,
                    type: 'error'
                });
                return;
            }

            this.$refs.viewMessage.show(message);
        }
    },
    computed: {
        ...mapGetters('messages', ['messages'])
    }
}
</script>
