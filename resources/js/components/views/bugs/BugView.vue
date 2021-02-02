<template>
    <transition
        leave-active-class="duration-300"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0">


        <div v-show="showModal" class="fixed inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div v-show="showModal" class="absolute z-10 inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                </transition>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div v-show="showModal"
                         class="relative z-10 inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6"
                         role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                         <div class="flex -m-6 mb-2 py-2 border-b border-gray-200 bg-gray-100 rounded-t-lg">
                            <div class="flex-1 ml-2 px-2 py-3 flex items-center">
                                <div class="text-gray-600">
                                    Bug Report</div>
                            </div>
                        </div> 
                        <div class="flex items-center">
                            <span class="text-2xl text-gray-800" v-text="title" />
                            <span class="text-gray-600 text-xl ml-2" v-text="id" />
                        </div>
                        <div class="flex mt-2 items-center text-gray-700">
                            <div class="px-3 text-white rounded-full py-2" :class="{'bg-green-400': isOpen, 'bg-red-400': !isOpen}">
                                <icon name="exclamation-circle" type="far" />
                                <span class="ml-2" v-text="bugStatus" />
                            </div>
                            <span class="ml-2" v-text="creator" />
                            <span>&nbsp;opened this issue&nbsp;</span>
                            <formatted-date :value="date" />
                        </div>
                        <div class="editor__content rounded py-3 px-3 border rounded shadow mt-5" v-html="content" />
                        

                        <div class="mt-5 sm:mt-6 flex">
                            <button @click="close"
                                    class="mt-3 justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                Back
                            </button>
                            <template v-if="isAdmin">
                                <button v-if="isOpen" @click="closeIssue"
                                        class="ml-2 mt-3 justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                        <icon class="text-red-500" name="check-circle" type="far" />
                                    <span class="ml-2">Close Issue</span>
                                </button>
                                <button v-else @click="openIssue"
                                    class="ml-2 mt-3 justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                    <icon class="text-green-500" name="exclamation-circle" type="far" />
                                    <span class="ml-2">Re-Open Issue</span>
                                </button>
                            </template>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </transition>
</template>
<script>
import { mapActions } from 'vuex';

export default {
    data() {
        return {
            showModal: false,
            bug: null,
        }
    },
    methods: {
        ...mapActions('bugs', ['CLOSE_BUG', 'OPEN_BUG']),
        close() {
            this.showModal = false;
            this.bug = null;
        },
        show(bug) {
            this.bug = bug;
            this.showModal = true;
        },
        closeIssue() {
            this.CLOSE_BUG(this.bug.id);
            this.close();
        },
        openIssue() {
            this.OPEN_BUG(this.bug.id);
            this.close();
        }
    },
    computed: {
        bugStatus() {
            return this.isOpen? 'Open': 'Closed';
        },
        isOpen() {
            return this.bug?.open;
        },
        title() {
            return this.bug?.title;
        },
        id() {
            return '#' + this.bug?.id;
        },
        content() {
            return this.bug?.content;
        },
        creator() {
            return this.bug?.creator;
        },
        date() {
            return this.bug?.created_at;
        },
        isAdmin() {
            return window.Laravel.is_admin;
        }
    }
}
</script>