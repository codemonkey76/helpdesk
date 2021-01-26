<template>
    <div class="flex-1 overflow-auto focus:outline-none" tabindex="0">
        <action-bar></action-bar>
        <main class="flex-1 relative pb-8 z-0 overflow-y-auto">
            <page-header></page-header>
            <div class="mt-8">
                <multi-select
                    name="userFilter"
                    label="User Filter"
                    class="w-75"
                    v-model="selectedUsers"
                    :options="users"
                />
            </div>
        </main>
    </div>
</template>
<script>
export default {
    data() {
        return {
            sidebarOpen: false,
            selectedUsers: [],
            users: [
                {value: 1, label: 'Shane Poppleton'},
                {value: 2, label: 'Len Groves'},
                {value: 3, label: 'Theresa Groves'}
            ]
        }
    },
    mounted() {

    },
    methods: {
        loadUsers() {
            axios.get('/api/users').then((response) => {
               console.log(response.data);
            });
        }
    }

}
</script>
