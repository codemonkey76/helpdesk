<template>
    <li>
        <a href="#" class="block hover:bg-gray-50">
            <div class="px-4 py-4 flex items-center sm:px-6">
                <div
                    class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between"
                >
                    <div>
                        <div
                            class="flex text-sm font-medium text-indigo-600 truncate"
                        >
                            <p v-text="bug.title"></p>
                        </div>
                        <div class="mt-2 flex">
                            <div
                                class="flex items-center text-sm text-gray-500"
                            >
                                <p>
                                    #<span v-text="bug.id" /> opened
                                    <formatted-date :value="bug.created_at" />
                                    by <span v-text="bug.creator" />
                                </p>
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
    props: ["bug"]
};
</script>
