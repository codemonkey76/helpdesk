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
                         <div class="flex -m-6 mb-2 py-2 border-b border-gray-200">
                            <div class="flex-1 ml-2 flex items-center">
                                <div class="text-gray-500">Message</div>
                            </div>
                        </div>        

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
            showModal: false
        }
    },
    methods: {
        close() {
            
        }
    }
}
</script>