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
                        <tbody v-if="messages.length" class="bg-white divide-y divide-gray-200">                        
                                <message v-for="(message,key) in groupedMessages[page]" :key="key" :message="message"></message>
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
                                    <paginator :per-page="per_page" v-model="page" :total-records="totalRecords" :max-page="maxPage"></paginator>
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
import {mapGetters, mapActions, mapMutations} from 'vuex';

export default {
    mounted() {
        this.GET_MESSAGES();

        window.Echo.channel('App.Models.User.' + window.Laravel.user_id + '.MessageSearch')
            .listen('SearchMessageResultsEvent', (e) => {
                this.SET_MESSAGES(e.results);
                this.$toast.open({message: 'Got new search results', type: 'info'});
            });

    },
    data() {
        return {
            page: 0,
            per_page: 10
        }
    },
    methods: {
        ...mapMutations('messages', ['SET_MESSAGES']),
        ...mapActions('messages', ['GET_MESSAGES']),
        messageClicked(id) {
            //console.log(id);
            this.$router.push('/messages/' + id);
        }
    },
    computed: {
        totalRecords() {
            return this.messages?.length
        },
        maxPage() {
            return this.groupedMessages?.length;
        },
        groupedMessages() {
            return _.chunk(this.messages, this.per_page);
        },
        ...mapGetters('messages', ['messages'])
    }

}
</script>
