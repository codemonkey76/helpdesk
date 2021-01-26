<template>
    <div class="flex-1 overflow-auto focus:outline-none" tabindex="0">
        <action-bar :search="false" />
        <main class="flex-1 relative pb-8 z-0 overflow-y-auto">
            <page-header />
            <div class="mt-8">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="space-y-8 divide-y divide-gray-200">
                        <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                            <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                                <info-field title="Personal Information"
                                            body="Use a permanent address where you can receive mail."/>
                                <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                    <photo-field v-model="formData.avatar" />
                                </div>
                                <div class="space-y-6 sm:space-y-5">
                                    <text-field name="first_name"
                                                label="First name"
                                                autocomplete="given-name"
                                                v-model="formData.first_name"
                                    />

                                    <text-field name="last_name"
                                                label="Last name"
                                                autocomplete="family-name"
                                                v-model="formData.last_name"
                                    />
                                    <text-field name="email"
                                                label="Email address"
                                                autocomplete="email"
                                                type="email"
                                                v-model="formData.email"
                                    />

                                    <text-field name="mobile"
                                                label="Mobile phone"
                                                autocomplete="mobile"
                                                type="text"
                                                v-model="formData.mobile"
                                    />
                                </div>
                            </div>

                            <div class="divide-y divide-gray-200 pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                                <info-field title="Notifications"
                                            body="We'll always let you know about important changes, but you pick what else you want to hear about."/>

                                <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                                    <div class="pt-6 sm:pt-5">
                                        <div role="group" aria-labelledby="label-email">
                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                                                <div>
                                                    <div
                                                        class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                                                        id="label-email">
                                                        By Email
                                                    </div>
                                                </div>
                                                <div class="mt-4 sm:mt-0 sm:col-span-2">
                                                    <div class="max-w-lg space-y-4">
                                                        <checkbox
                                                            name="notification_email_unassigned_tickets"
                                                            label="Unassigned Tickets"
                                                            help-text="Get notified when a new unassigned ticket is created."
                                                            v-model="formData.notification_email_unassigned_tickets"
                                                        />
                                                        <checkbox
                                                            name="notification_email_assigned_tickets"
                                                            label="Assigned Tickets"
                                                            help-text="Get notified when a ticket is assigned to you."
                                                            v-model="formData.notification_email_assigned_tickets"
                                                        />
                                                        <checkbox
                                                            name="notification_email_replies"
                                                            label="Replies"
                                                            help-text="Get notified when someone replies to one of your tickets."
                                                            v-model="formData.notification_email_replies"
                                                        />
                                                        <checkbox
                                                            name="notification_email_messages"
                                                            label="Messages"
                                                            help-text="Get notified when another user sends you a message."
                                                            v-model="formData.notification_email_messages"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-6 sm:pt-5">
                                        <div role="group" aria-labelledby="label-notifications">
                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                                                <div>
                                                    <div
                                                        class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                                                        id="label-notifications">
                                                        Push Notifications
                                                    </div>
                                                </div>
                                                <multi-option name="push_notifications" :options="pushOptions"
                                                              v-model="formData.push_notifications"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5">
                            <div class="flex justify-end">
                                <button @click="resetForm" type="button"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Cancel
                                </button>
                                <button @click="saveProfile" type="submit"
                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import InfoField from "../forms/profile/fields/InfoField";
import Checkbox from "../forms/profile/fields/Checkbox";
import {mapState} from 'vuex';

export default {
    name: "Profile",
    components: {Checkbox, InfoField},
    data() {
        return {
            pushOptions: [
                {id: 'push_everything', label: 'Everything'},
                {id: 'push_email', label: 'Same as email'},
                {id: 'push_nothing', label: 'No push notifications'},
            ],

            formData: this.setFormData()
        }
    },
    mounted() {
        this.formData = this.setFormData()
    },
    computed: {
        ...mapState('users', ['user']),
    },
    watch: {
        user() {
            this.formData = this.setFormData();
        }
    },
    methods: {
        setFormData() {
            return {
                'first_name': this.user?.first_name,
                'last_name': this.user?.last_name,
                'email': this.user?.email,
                'mobile': this.user?.mobile,
                'avatar': this.user?.avatar,
                'company_id': this.user?.company_id,
                'notification_email_unassigned_tickets': this.user?.notification_email_unassigned_tickets,
                'notification_email_assigned_tickets': this.user?.notification_email_assigned_tickets,
                'notification_email_replies': this.user?.notification_email_replies,
                'notification_email_messages': this.user?.notification_email_messages,
                'push_notifications': this.user?.push_notifications
            };
        },
        resetForm() {
            this.formData = this.setFormData();
        },
        saveProfile() {
            //Make a post request to save the user profile.
            axios.post('/api/users', {
                ...this.formData,
                _method: 'patch'
            }).then(() => {
                this.$toast.open('Profile saved successfully!');
            })
            .catch(() => {
                this.$toast.open('Error occured!', 'error');
            });



        }
    }
}
</script>

<style scoped>

</style>
