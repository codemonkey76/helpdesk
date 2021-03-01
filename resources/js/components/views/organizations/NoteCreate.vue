<template>
    <create-form :show="showModal" @cancel="cancel" @confirm="addNote" :title="title">
        <editor
            id="content"
            v-model="content"></editor>

        <template #confirm>
            <icon name="sticky-note" />
            <span class="ml-2" v-text="title" />
        </template>
    </create-form>
</template>
<script>

export default {
    props: ['action', 'title'],
    data() {
        return {
            showModal: false,
            content: '',
            options: null
        }
    },
    methods: {
        cancel() {
            this.content = '';
            this.showModal = false;
        },
        show(options) {
            this.options = options;
            if (this.options.hasOwnProperty('content')) this.content = this.options.content;
            this.showModal = true;
        },
        addNote() {
            this.showModal = false;
            let note = new FormData();
            note.append('note', this.content);
            this.$store.dispatch(this.action, {...this.options, note});
            this.content = '';
        }
    }
}
</script>
