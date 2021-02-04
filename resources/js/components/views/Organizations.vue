<template>
    <div class="flex-1 overflow-auto focus:outline-none" tabindex="0">
        <action-bar :search="true" placeholder="Search organizations" :action="action"></action-bar>
        <main class="flex-1 relative pb-8 overflow-y-auto">
            <page-header @action="createOrganizationDialog" :action-enabled="true"
                         action-label="Create Organization"></page-header>
            <div v-if="! organizationId" class="mt-8">
                <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                    Organizations
                </h2>
                <organization-list @open-organization="openOrganization"/>
            </div>
            <div v-else class="max-w-6xl mx-auto mt-8 px-4 sm:px-6">
                <template v-if="organization">
                <div class="pb-5 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" v-text="organization.name" />
                </div>

                    <div class="mt-2">
                        <label for="country" class="block text-sm font-medium text-gray-700">
                            Head Office
                        </label>
                        <div class="mt-1">
                            <select id="country" name="country" autocomplete="country" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md">
                                <option v-for="company in companiesByOrganization(organizationId)" :value="company.id">{{company.name}}</option>
                            </select>
                        </div>
                        <organization-notes :organization="organization"></organization-notes>
                    </div>
                </template>
            </div>
            <organization-create ref="createOrganization"/>
        </main>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';

export default {
    data() {
        return {
            action: 'bugs/SEARCH_ORGANIZATIONS',
        }
    },
    computed: {
        ...mapGetters('organizations', ['organizations']),
        ...mapGetters('companies', ['companiesByOrganization']),
        organizationId() {
            if (this.$route.params.hasOwnProperty('pathMatch')) return this.$route.params.pathMatch.substring(1);
            return null;
        },
        organization() {
            return this.organizations.find(x => x.id===+this.organizationId);
        },

    },
    methods: {
        createOrganizationDialog() {
            this.$refs.createOrganization.show();
        },
        openOrganization(organization) {
            this.$refs.viewOrganization.show(organization);
        },
    }
}
</script>
