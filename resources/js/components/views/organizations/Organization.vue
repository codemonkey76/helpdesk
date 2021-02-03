<template>
    <li>
        <a href="#" @click="openOrganization" class="block hover:bg-gray-50">
            <div class="px-4 py-4 flex items-center sm:px-6">
                <div
                    class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between"
                >
                    <div>
                        <div
                            class="flex text-sm font-medium text-indigo-600 truncate"
                        >{{organization.name}}

                        </div>
                        <div class="mt-2 flex">
                            <div
                                class="flex items-center text-sm text-gray-500"
                            >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </li>
</template>
<script>
export default {
    props: ["organization"],
    methods: {
        openOrganization() {
            this.$emit('open-organization', this.organization);
        }
    }
};
</script>
