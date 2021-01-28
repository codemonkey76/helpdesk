<template>
    <tr class="bg-white">
        <td class="max-w-0 px-3 py-4 whitespace-nowrap text-sm text-gray-900">
            <i v-if="message.direction==='received'" class="far fa-inbox-in h-5 w-5 text-green-400 group-hover:text-green-500"></i>
            <i v-else class="far fa-inbox-out h-5 w-5 text-red-400 group-hover:text-red-500"></i>
        </td>
        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 group-hover:text-gray-900 truncate" v-text="user">
        </td>
        <td class="max-w-0 w-full px-3 py-4 whitespace-nowrap text-sm text-gray-900">
            <div class="flex">
                <a href="#" class="group inline-flex space-x-2 truncate text-sm">
                    <p class="text-gray-500 truncate group-hover:text-gray-900" v-html="message.bodyExcerpt" />
                </a>
            </div>
        </td>
        <td class="px-3 py-4 text-center whitespace-nowrap text-sm text-gray-500">
            <router-link :to="'/messages/' + message.id"
               class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <icon name="envelope-open-text" />
            </router-link>
        </td>
        <td class="px-3 py-4 text-center whitespace-nowrap text-sm text-gray-500">
            <a href="#" @click="ARCHIVE_MESSAGE(message.id)"
               class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <icon name="archive" />
            </a>
        </td>
        <td class="px-3 py-4 text-right whitespace-nowrap text-sm text-gray-500">
            <formatted-date :value="message.created_at"></formatted-date>
        </td>
    </tr>
</template>
<script>
import { mapActions } from 'vuex';
export default {
    props: ['message'],
    computed: {
        user() {
            return this.message.direction==='received'?this.message.fromUser:this.message.toUser;
        }
    },
    methods: {
        ...mapActions('messages', ['ARCHIVE_MESSAGE'])
    }
}
</script>
