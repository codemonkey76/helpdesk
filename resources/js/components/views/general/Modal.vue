<template>
    <transition
        leave-active-class="duration-300"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0">

        <div v-show="show" class="fixed inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div v-show="show" class="absolute z-10 inset-0 transition-opacity" aria-hidden="true">
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
                    <div v-show="show"
                         class="relative z-10 inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6"
                         role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <div class="flex -m-6 mb-2 py-2 border-b border-gray-200 bg-gray-100 rounded-t-lg">
                            <div class="flex-1 ml-2 px-2 py-3 flex items-center">
                                <div class="text-gray-600">
                                    <slot name="header"></slot>
                                </div>
                            </div>
                        </div>
                        <slot name="content">

                        </slot>

                        <div class="mt-5 sm:mt-6 flex">
                            <slot name="footer">

                            </slot>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    props: ['show'],
}
</script>
