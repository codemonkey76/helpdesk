<template>
<create-form :show="showModal" @cancel="cancel" @confirm="sendMessage" title="Send Message">

    <label
        for="content"
        class="block text-sm font-medium text-gray-700">
        To
    </label>
    <select-with-status ref="selectWithStatus" v-model="user"></select-with-status>

    <label
        for="content"
        class="mt-2 block text-sm font-medium text-gray-700">
        Content
    </label>
    <editor
        id="content"
        v-model="content"></editor>

    <template #confirm>
        <icon name="envelope" />
        <span class="ml-2">Send Message</span>
    </template>
</create-form>
</template>
<script>
import { mapActions } from 'vuex';

export default {
    data() {
        return {
            showModal: false,
            content: '',
            user: 1
        }
    },
    methods: {
        ...mapActions('messages', ['SEND_MESSAGE']),
        cancel() {
            this.content = '';
            this.user = 1;
            this.showModal = false;
        },
        show() {
            this.$refs.selectWithStatus.refresh();
            this.showModal = true;
        },
        sendMessage() {
            this.showModal = false;
            let fd = new FormData();

            fd.append('to_user_id', this.user);
            fd.append('body', this.content);
            this.SEND_MESSAGE(fd);
        }
    }
}
</script>

<style>

</style>
