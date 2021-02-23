<template>
    <div class="flex-1 overflow-auto focus:outline-none" tabindex="0">
        <action-bar :search="true" placeholder="Search messages" :action="action"></action-bar>
        <main class="flex-1 relative pb-8 overflow-y-auto">
            <page-header @action="sendMessageDialog" :action-enabled="true" action-label="Send message"></page-header>
            <div class="mt-8">

                <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                    Messages
                </h2>
                <message-list v-if="messages" :messages="messages"></message-list>
                <message-create ref="createMessage"></message-create>
                <message-view ref="viewMessage"></message-view>

            </div>
        </main>
    </div>
</template>
<script>
import {mapGetters, mapActions, mapMutations} from 'vuex';

export default {
    data() {
        return {
            action: 'messages/SEARCH_MESSAGES',
            messageChannel: 'App.Models.Message.' + window.Laravel.user_id,
            searchChannel: 'App.Models.User.' + window.Laravel.user_id + '.SearchResults'
        }
    },
    created() {
        this.fetchData();
    },
    beforeDestroy() {
        window.Echo.private(this.messageChannel).stopListening('MessageCreatedEvent');
        window.Echo.channel(this.searchChannel).stopListening('SearchMessageResultsEvent');
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
        ...mapActions('messages', ['GET_MESSAGES', 'GET_PAGINATED_MESSAGES']),
        ...mapMutations('messages', ['SET_MESSAGES']),
        fetchData() {
            this.GET_PAGINATED_MESSAGES(1);
            window.Echo.private(this.messageChannel).listen('MessageCreatedEvent', this.newMessage);
            window.Echo.channel(this.searchChannel).listen('SearchMessageResultsEvent', this.searchMessageResults)
        },
        sendMessageDialog() {
            this.$refs.createMessage.show();
        },
        searchMessageResults(e) {
            // console.log('Calling SET_MESSAGES mutation with results:');
            // console.log(e.results);
            // console.log(this);
            // console.log('is function?', this.SET_MESSAGES, typeof this.SET_MESSAGES === 'function')
            // this.SET_MESSAGES(e.results);
            this.$toast.open({message: 'Message search results received', type: 'info'});
            this.$store.commit('messages/SET_MESSAGES', e.results);

        },
        messageId(route) {
                if (route.params.hasOwnProperty('pathMatch')) return route.params.pathMatch.substring(1);
            return null;
        },
        showMessage(to) {
            // Get message from existing data
            let id = this.messageId(to);

            if (!id) return;

            let message = this.messages.data.find(x => x.id === parseInt(id));
            if (message) {
                this.$refs.viewMessage.show(message);
                return;
            }
            // if not found get from api call

            axios.get('/api/messages/' + id)
                .then(response => {
                    this.$refs.viewMessage.show(response.data);
                }).catch(error => {
                this.$toast.open({
                    message: 'Could not find message: ' + to.params.id,
                    type: 'error'
                });
            });
        }
    },
    computed: {
        ...mapGetters('messages', ['messages'])
    }
}
</script>
