<template>
    <div class="flex-1 overflow-auto focus:outline-none" tabindex="0">
        <action-bar :search="true" placeholder="Search bugs" :action="action"></action-bar>
        <main class="flex-1 relative pb-8 overflow-y-auto">
            <page-header @action="reportBugDialog" :action-enabled="true" action-label="Report bug"></page-header>
            <div class="mt-8">

                <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                    Bugs
                </h2>
                <bug-list @open-bug="openBug"></bug-list>
                
                <bug-create ref="createBug"></bug-create>

                <bug-view ref="viewBug"></bug-view>
            
            </div>
        </main>
    </div>
</template>
<script>
export default {
    data() {
        return {
             action: 'bugs/SEARCH_BUGS',
        }
    },
    methods: {
        reportBugDialog() {
            this.$refs.createBug.show();
        },
        openBug(bug) {
            this.$refs.viewBug.show(bug);
        }
    }
}
</script>
