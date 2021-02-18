<template>
    <div class="flex flex-col flex-1 focus:outline-none" tabindex="0">
        <action-bar :search="true" placeholder="Search organizations" :action="action"></action-bar>
        <main class="flex flex-col flex-1 relative overflow-hidden">
            <page-header @action="createOrganizationDialog" :action-enabled="true"
                         action-label="Create Organization"></page-header>
            <div v-if="! organizationId" class="mt-8">
                <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                    Organizations
                </h2>
                <organization-list @open-organization="openOrganization"/>
            </div>
            <div v-else class="flex flex-col max-w-6xl mx-auto p-6 sm:px-6 overflow-hidden">
                <template v-if="organization">

                    <div class="pb-5 border-b border-gray-200"> <!-- Organization Name -->
                        <h3 class="text-lg leading-6 font-medium text-gray-900" v-text="organization.name"/>
                    </div>

                    <div class="mt-2"> <!-- Head office selection -->
                        <label for="headOffice" class="block text-sm font-medium text-gray-700">
                            Head Office
                        </label>
                        <div class="mt-1">
                            <select id="headOffice" name="headOffice"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md">
                                <option v-for="company in companiesByOrganization(organizationId)" :value="company.id">
                                    {{ company.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex flex-col flex-1 overflow-hidden">
                        <label class="block text-sm font-medium text-gray-700">
                            Notes
                        </label>
                        <organization-notes :organization="organization"></organization-notes>
                    </div>


                    <div class="mt-4">
                        <button data-v-7fb418a7="" type="button"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                            Add Note
                        </button>
                    </div>
                </template>
            </div>
            <organization-create ref="createOrganization"/>
        </main>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';

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
            return this.organizations.find(x => x.id === +this.organizationId);
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
