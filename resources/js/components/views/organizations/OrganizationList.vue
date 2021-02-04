<template>

    <item-list>
        <template #header>
            <div class="px-3 py-3">
                Organizations
            </div>
        </template>

        <template #content>
            <organization v-for="(organization,key) in chunkedOrganizations[currentPage-1]" :key="key" :organization="organization" @open-organization="openOrganization(organization)"></organization>
        </template>

        <template #empty>
            <li v-if="!totalRecords">
                <div class="px-4 py-4 flex items-center sm:px-6 italic text-gray-500 text-sm empty-slot">
                    There are no organizations at this time.
                </div>
            </li>
        </template>

        <template #footer>
            <v-paginator
                :current-page="currentPage"
                :total-pages="totalPages"
                :total-records="totalRecords"
                :per-page="perPage"
                @page-change="pageChanged"
            ></v-paginator>
        </template>
    </item-list>

</template>
<script>
import {mapGetters} from 'vuex';
import Organization from "./Organization";

export default {
    components: {Organization},
    data() {
        return {
            perPage: 10,
            currentPage: 1,
        }
    },
    methods: {
        pageChanged(selectedPage) {
            this.currentPage = selectedPage;
        },
        openOrganization(organization) {
            this.$emit('open-organization', organization);
        }
    },
    computed: {
        ...mapGetters('organizations', ['organizations']),
        chunkedOrganizations() {
            return _.chunk(this.organizations, this.perPage);
        },
        totalPages() {
            return this.chunkedOrganizations?.length;
        },
        totalRecords() {
            return this.organizations?.length;
        },
    }
}
</script>
