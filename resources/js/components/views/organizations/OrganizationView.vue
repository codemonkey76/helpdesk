<template>
    <modal @close="close" :show="showModal">
        <template #header>
            Organization
        </template>
        <template #content>
            <div>
                <div class="block text-sm font-medium text-gray-700">Organization Name</div>
                <div class="mt-1 shadow-sm block w-full sm:text-sm border px-3 py-2 border-gray-300 rounded-md"
                     v-text="organization.name"/>
            </div>
            <div>
                <div class="block text-sm font-medium text-gray-700">Head Office</div>
                <div class="mt-1 shadow-sm block w-full sm:text-sm border px-3 py-2 border-gray-300 rounded-md"
                     v-text="organization.name"/>
            </div>
        </template>
        <template #footer>
            <button @click="close"
                    class="mt-3 justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                Back
            </button>
        </template>
    </modal>
</template>
<script>
export default {
    data() {
        return {
            showModal: false,
            organization: null
        }
    },
    methods: {
        show(organization) {
            this.organization = organization;
            this.showModal = true;
        },
        close() {
            this.showModal = false;
        }
    }
}
</script>
