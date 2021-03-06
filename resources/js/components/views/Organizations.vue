<template>
    <div class="flex flex-col flex-1 focus:outline-none" tabindex="0">
        <action-bar :search="true" :placeholder="searchText" :action="searchAction"
                    :options="searchOptions"></action-bar>
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
                    <div>
                        <router-link to="/organizations"
                                     class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                            <i class="fas fa-chevron-circle-left mr-2"></i> Back
                        </router-link>
                    </div>
                    <div class="mt-2 pb-5 border-b border-gray-200"> <!-- Organization Name -->
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
                        <organization-notes @edit-note="editNote" @delete-note="deleteNote" :notes="notes"></organization-notes>
                    </div>
                    <paginator @page-change="fetchData" :items="notes"></paginator>


                    <div class="mt-4">
                        <button @click="createNote" type="button"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                            Add Note
                        </button>
                    </div>
                    <note-create ref="createNote" action="organizationNotes/ADD_NOTE" title="Add Note"></note-create>
                    <note-create ref="editNote" action="organizationNotes/UPDATE_NOTE" title="Edit Note"></note-create>

                </template>
            </div>
            <organization-create ref="createOrganization"/>
        </main>
    </div>
</template>
<script>
import {mapGetters, mapActions, mapMutations} from 'vuex';
import Swal from 'sweetalert2';

export default {
    data() {
        return {
            page: 1,
        }
    },
    computed: {
        ...mapGetters('organizations', ['organizations']),
        ...mapGetters('organizationNotes', ['notes']),
        ...mapGetters('companies', ['companiesByOrganization']),
        searchOptions() {
            return {orgId: this.organizationId};
        },
        organizationId() {
            if (this.$route.params.hasOwnProperty('pathMatch')) return this.$route.params.pathMatch.substring(1);
            return null;
        },
        searchAction() {
            if (!this.organizationSelected)
                return 'organizations/SEARCH_ORGANIZATIONS';

            return 'organizationNotes/SEARCH_NOTES';
        },
        organizationSelected() {
            return (this.$route.params.pathMatch.length > 0);
        },
        searchText() {
            if (!this.organizationSelected)
                return "Search organizations";
            else
                return "Search notes";
        },
        organization() {
            return this.organizations.find(x => x.id === +this.organizationId);
        },
        noteSearchChannel() {
            return `User.${window.Laravel.user_id}.Organization.${this.organizationId}.Notes.Search`;
        },
        noteChannel() {
            return 'Organization.' + this.organizationId + '.Notes';
        }

    },
    watch: {
        organizationId: {
            handler: function (search) {
                this.fetchData(this.page);
            },
            deep: true,
            immediate: true
        }
    },
    beforeDestroy() {
        window.Echo.private(this.noteChannel).stopListening('NoteCreatedEvent');
        window.Echo.private(this.noteSearchChannel).stopListening('SearchOrganizationNotesResultsEvent');
    },
    mounted() {
        window.Echo.private(this.organizationsChannel).listen('OrganizationCreatedEvent', this.)
    },
    methods: {
        ...mapActions('organizationNotes', ['GET_PAGINATED_NOTES', 'DELETE_NOTE']),
        ...mapMutations('organizationNotes', ['SET_NOTES']),
        fetchData(page) {
            this.page = page;
            if (this.organizationId) {
                window.Echo.private(this.noteChannel).stopListening('NoteCreatedEvent');
                window.Echo.private(this.noteChannel).stopListening('NoteUpdatedEvent');
                window.Echo.private(this.noteChannel).stopListening('NoteDeletedEvent');
                window.Echo.private(this.noteSearchChannel).stopListening('SearchOrganizationNotesResultsEvent');
                this.GET_PAGINATED_NOTES({orgId: this.organizationId, page: this.page});
                window.Echo.private(this.noteChannel).listen('NoteCreatedEvent', this.newNote);
                window.Echo.private(this.noteChannel).listen('NoteUpdatedEvent', this.newNote);
                window.Echo.private(this.noteChannel).listen('NoteDeletedEvent', this.noteDeleted);
                window.Echo.private(this.noteSearchChannel).listen('SearchOrganizationNotesResultsEvent', this.newNoteSearchResults);
                console.log("Adding listener on " + this.noteChannel);
            }
        },
        createOrganizationDialog() {
            this.$refs.createOrganization.show();
        },
        openOrganization(organization) {
            this.$refs.viewOrganization.show(organization);
        },
        createNote() {
            this.$refs.createNote.show({orgId: this.organizationId});
        },
        editNote(payload) {
            this.$refs.editNote.show({orgId: this.organizationId, noteId: payload.id, content: payload.note});
        },
        deleteNote(payload) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.DELETE_NOTE(payload)
                    Swal.fire(
                        'Deleted!',
                        'Note has been deleted.',
                        'success'
                    )
                }
            });
        },
        newNoteSearchResults(e) {
            this.$toast.open({message: 'Note search results received', type: 'info'});
            this.SET_NOTES(e.results);
        },
        newNote() {
            console.log("Received NoteCreatedEvent, fetching data");
            if (this.organizationId) {
                this.GET_PAGINATED_NOTES({orgId: this.organizationId, page: this.page});
            }
        },
        noteDeleted() {
            console.log("Received NoteDeletedEvent");
            this.newNote();
        }
    }
}
</script>
