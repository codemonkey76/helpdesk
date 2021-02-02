<template>
    <create-form :show="showForm" @cancel="cancel" @confirm="confirm" title="Report Bug">
        <label 
            for="title" 
            class="block text-sm font-medium text-gray-700">
            Title
        </label>
        <input 
            type="text" 
            name="title" 
            id="title" 
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            required
            v-model="title">
        
        <p class="py-4 text-lg text-gray-500">
            Please describe the issue acurately, including steps to reproduce. You can also paste in screenshots
        </p> 
        
        <label 
            for="content" 
            class="block text-sm font-medium text-gray-700">
            Content
        </label>
        <editor 
            id="content" 
            v-model="content"></editor>

        <template #confirm>
            <icon name="bug" />
            <span class="ml-2">Report Bug</span>
        </template>
    </create-form>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    data() {
        return {
            showForm: false,
            title: '',
            content: ''
        }
    },
    methods: {
        ...mapActions('bugs', ['REPORT_BUG']),
        show() {
            this.showForm = true;
        },
        confirm() {
            this.REPORT_BUG({
                title: this.title, 
                content: this.content,
                creator: this.user.fullName
            });

            this.$toast.open({
                message: 'Bug report submitted clicked confirm',
                type: 'info'
            });

            this.showForm = false;
        },
        cancel() {
            this.content = '';
            this.showForm = false;
        }
    },
    computed: {
        ...mapGetters('users', ['user'])
    }
}
</script>
