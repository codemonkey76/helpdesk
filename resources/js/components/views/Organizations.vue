<template>
    <div class="flex-1 overflow-auto focus:outline-none" tabindex="0">
        <action-bar :search="true" placeholder="Search organizations" :action="action"></action-bar>
        <main class="flex-1 relative pb-8 overflow-y-auto">
            <page-header @action="createOrganizationDialog" :action-enabled="true" action-label="Create Organization"></page-header>
            <div class="mt-8">

                <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                    Organizations
                </h2>
                <organization-list @open-organization="openOrganization" />
                <organization-create ref="createOrganization" />
                <organization-view ref="viewOrganization" />
            </div>
        </main>
    </div>
</template>
<script>
export default {
    data() {
        return {
            action: 'bugs/SEARCH_ORGANIZATIONS',
        }
    },
    methods: {
        createOrganizationDialog() {
            this.$refs.createOrganization.show();
        },
        openOrganization(organization) {
            this.$refs.viewOrganization.show(organization);
        }
    }
}
</script>
