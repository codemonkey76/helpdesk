<template>
    <nav class="bg-white px-4 py-3 flex items-center justify-between border-gray-200 sm:px-6"
         aria-label="Pagination">
        <div class="hidden sm:block">
            <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium" v-text="items.from"/>
                to
                <span class="font-medium" v-text="items.to"/>
                of
                <span class="font-medium" v-text="items.total"/>
                results
            </p>
        </div>
        <template v-if="items.links">
        <div v-if="items.links.length>0" class="flex-1 flex justify-between sm:justify-end">
            <button @click="prevPage()"
                         :disabled="items.current_page <= 1"
                         class="disabled:opacity-50 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                         v-html="items.links[0].label">
            </button>
            <button @click="nextPage()"
                         :disabled="items.current_page > items.last_page"
                         class="disabled:opacity-50 ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"

                        v-html="items.links[items.links.length-1].label">
            </button>
        </div>
        </template>
    </nav>
</template>
<script>
export default {
    props: ['items'],
    methods: {
        prevPage() {
            console.log("prevPage clicked, firing page-change event");
            this.$emit('page-change', this.items.current_page-1);
        },
        nextPage() {
            console.log("nextPage clicked, firing page-change event");
            this.$emit('page-change', this.items.current_page+1);
        }
    }
}
</script>
