<template>
    <create-form :show="showForm" @close="close" ></create-form>
</template>
<script>
export default {
    data() {
        return {
            showForm: false
        }
    },
    methods: {
        show() {
            this.showForm = true;
        },
        close() {
            this.showForm = false;
        }
    }
}
</script>
