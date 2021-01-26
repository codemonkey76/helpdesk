<template>
    <div class="relative flex items-start">
        <div class="flex items-center h-5">
            <input :id="name" :name="name" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" @change="changed" v-model="value">
        </div>
        <div class="ml-3 text-sm">
            <label :for="name" class="font-medium text-gray-700" v-text="label" />
            <p class="text-gray-500" v-text="helpText" />
        </div>
    </div>
</template>

<script>
export default {
    name: "Checkbox",
    props: ['name', 'label', 'helpText', 'value'],
    methods: {
        changed(event) {
            this.$emit('input', event.target.checked);
        }
    }
}
</script>

<style scoped>

</style>
