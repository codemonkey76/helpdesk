<template>
    <div class="mt-6 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-200">
                <li>
                    <div class="flex bg-gray-50 text-gray-800 items-center sm:px-6">
                        <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <div class="flex items-center text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <slot name="header"></slot>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <slot v-if="hasContentSlot" name="content">
                </slot>
                <slot v-if="hasEmptySlot" name="empty">
                </slot>
                <li>
                    <slot name="footer"></slot>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    computed: {
        hasEmptySlot() {
            return !!this.$slots.empty
        },
        hasContentSlot() {
            return !!this.$slots.content;
        },
        hasFooterSlot() {
            return !!this.$slots.footer;
        },
        hasHeaderSlot() {
            return !!this.$slots.header;
        }
    }
}
</script>
