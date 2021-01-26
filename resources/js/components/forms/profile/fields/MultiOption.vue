<template>
    <div class="sm:col-span-2">
        <div class="max-w-lg">
            <p class="text-sm text-gray-500">These are delivered via SMS to your mobile phone.</p>
            <div class="mt-4 space-y-4">
                <div v-for="option in options" class="flex items-center">
                    <input :id="option.id" :name="name" @change="changed(option.id)"
                           type="radio"
                           class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" :checked="option.id==value">

                    <label :for="option.id"
                           class="ml-3 block text-sm font-medium text-gray-700" v-text="option.label" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MultiOption",
    props: ['name', 'options', 'value'],
    methods: {
        changed(option) {
            console.log(option)
            this.$emit('input', option);
        }
    }
}
</script>

<style scoped>

</style>
