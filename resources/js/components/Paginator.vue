<template>
    <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
         aria-label="Pagination">
        <div class="hidden sm:block">
            <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium" v-text="from"/>
                to
                <span class="font-medium" v-text="to"/>
                of
                <span class="font-medium" v-text="totalRecords"/>
                results
            </p>
        </div>
        <div class="flex-1 flex justify-between sm:justify-end">
            <a href="#" @click="prevPage()"
               class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
            </a>
            <a @click="nextPage()" href="#"
               class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
            </a>
        </div>
    </nav>
</template>
<script>
export default {
    props: ['perPage', 'value', 'totalRecords', 'maxPage'],
    data() {
        return {
            page: 1
        }
    },
    methods: {
        prevPage() {
            if (this.page > 0) {
                this.page--;
                this.$emit('input', this.page);
            }
        },
        nextPage() {
            if (this.page < this.maxPage-1) {
                this.page++;
                this.$emit('input', this.page);
            }
        }
    },
    computed: {
        from() {
            return (this.totalRecords === 0) ? 0 : (1 + this.perPage * this.value);
        },
        to() {
            return Math.min(this.totalRecords, this.perPage + (this.perPage*this.page));
        }
    }
}
</script>
