<template>
    <div class="mt-6 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-200">
                <li>
                    <div
                        class="px-4 py-4 flex items-center sm:px-6">
                        <div
                            class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <div
                                    class="flex items-center text-sm font-medium text-gray-800">
                                    <a href="#" @click="viewOpen" class="flex items-center">
                                        <icon type="far" name="exclamation-circle"></icon>
                                        <div class="ml-2"><span v-text="totalOpenRecords" /> Open</div>
                                    </a>
                                    <a href="#" @click="viewClosed" class="flex ml-4 items-center text-gray-400">
                                        <icon name="check"></icon>
                                        <div class="ml-2"><span v-text="totalClosedRecords" /> Closed</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <template v-if="viewingOpen">

                <template v-if="openBugs.length">
                    <bug v-for="(bug,key) in groupedOpenBugs[openPage]" :key="key" :bug="bug" @open-bug="openBug"></bug>
                </template>
                <li v-else>
                    <div class="px-4 py-4 flex items-center sm:px-6 italic text-gray-500 text-sm ">No bugs reported</div>
                </li>
        
                <li>
                    <paginator :per-page="per_page" :total-records="totalOpenRecords" :max-page="maxOpenPage" v-model="openPage"></paginator>
                </li>
                </template>
                <template v-else>

                <template v-if="closedBugs.length">
                    <bug v-for="(bug,key) in groupedClosedBugs[closedPage]" :key="key" :bug="bug" @open-bug="openBug"></bug>
                </template>
                <li v-else>
                    <div class="px-4 py-4 flex items-center sm:px-6 italic text-gray-500 text-sm ">No bugs reported</div>
                </li>
        
                <li>
                    <paginator :per-page="per_page" :total-records="totalClosedRecords" :max-page="maxClosedPage" v-model="closedPage"></paginator>
                </li>

                </template>
            </ul>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions, mapMutations } from 'vuex';

export default {
    mounted() {
        this.GET_BUGS();

        window.Echo.channel('App.Models.User.' + window.Laravel.user_id + '.BugSearch')
            .listen('SearchBugResultsEvent', (e) => {
                this.SET_BUGS(e.results);
                this.$toast.open({
                    message: 'Got new search results',
                    type: 'info'
                });
            })

    },
    data() {
        return {
            openPage: 0,
            closedPage: 0,
            per_page: 10,
            viewingOpen: true
        }
    },
    methods: {
        ...mapActions('bugs', ['GET_BUGS']),
        ...mapMutations('bugs', ['SET_BUGS']),
        viewOpen() {
            this.viewingOpen = true;
        },
        viewClosed() {
            this.viewingOpen = false;
        },
        openBug(bug) {
            this.$emit('open-bug', bug);
        }
    },
    computed: {
        totalOpenRecords() {
            return this.openBugs?.length
        },
        totalClosedRecords() {
            return this.closedBugs?.length
        },
        maxOpenPage() {
            return this.groupedOpenBugs?.length;
        },
        maxClosedPage() {
            return this.groupedClosedBugs?.length;
        },
        groupedOpenBugs() {
            return _.chunk(this.openBugs, this.per_page);
        },
        groupedClosedBugs() {
            return _.chunk(this.closedBugs, this.per_page);
        },

        ...mapGetters('bugs', ['openBugs', 'closedBugs'])
    }
}
</script>
