<template>
    <create-form :show="showForm" @cancel="cancel" @confirm="confirm" title="Create Organization">
        <label
            for="name"
            class="block text-sm font-medium text-gray-700">
            Name
        </label>
        <input
            type="text"
            name="name"
            id="name"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            required
            v-model="name">
    </create-form>
</template>
<script>

export default {

    data() {
        return {
            showForm: false,
            name: ''
        }
    },
    methods: {
        show() {
            this.showForm = true;
        },
        cancel() {
            this.showForm = false;
        },
        confirm() {
            this.CREATE_ORGANIZATION({
                name: this.name
            });

        }
    }
}
</script>
