<template>
    <create-form :show="showModal" @cancel="cancel" @confirm="sendMessage" title="Add Note">
        <editor
            id="content"
            v-model="content"></editor>

        <template #confirm>
            <icon name="envelope" />
            <span class="ml-2">Add Note</span>
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
        }
    },
    methods: {
        ...mapActions('organizations', ['ADD_NOTE']),
        cancel() {
            this.content = '';
            this.showModal = false;
        },
        show() {
            this.showModal = true;
        },
        sendMessage() {
            this.showModal = false;
            let note = new FormData();
            let orgId = this.$route.params.pathMatch.substring(1);
            console.log('Org Id:' + orgId);
            note.append('note', this.content);
            this.ADD_NOTE({note, orgId});
        }
    }
}
</script>

<style>

</style>
