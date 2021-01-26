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

                <!-- This element is to trick the browser into centering the modal contents. -->
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
                        <div class="flex -m-6 mb-2 py-2 border-b border-gray-200"> <!-- Header -->
                            <i v-if="sent"
                               class="far fa-inbox-out fa-3x mx-2 text-red-400 group-hover:text-red-500"></i>
                            <i v-else
                               class="far fa-inbox-in fa-3x mx-2 text-green-400 group-hover:text-green-500"></i>
                            <div class="flex-1 ml-2 flex items-center">
                                <div class="text-gray-500">Message {{ direction }} <strong>{{user}}</strong> <i v-text="when"></i></div>
                            </div>
                        </div>
                        <div class="max-w-2xl mt-4 text-gray-500 border rounded p-2 trix-editor" v-html="html" />

                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                            <button @click="close"
                                    class="mt-3 justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                Close
                            </button>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            showModal: false,
            html: '',
            sent: false,
            user: '',
            when: null
        }
    },
    methods: {
        show(message) {
            this.html = message.body;
            this.sent = (message.from_user_id !== message.to_user_id);
            this.user = this.sent ? message.toUser : message.fromUser;
            this.when = this.$moment.utc(message.created_at).local().fromNow();
            this.showModal = true;
        },
        close() {
            this.showModal = false;
            this.$router.push('/messages');
        }
    },
    computed: {
        direction() {
            return this.sent?'Sent to':'Received from'
        },

    }
}
</script>

<style>

</style>
