<template>
    <div
        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
        <label :for="name"
               class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
            {{  label }}
        </label>
        <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input :type="type" :name="name" :id="name"
                   :autocomplete="autocomplete"
                   @input="changed"
                   class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" :class="type==='text'?'sm:max-w-xs':''" v-model="content">
        </div>
    </div>
</template>

<script>
export default {
    name: "TextField",
    props: {
        label: String,
        name: String,
        autocomplete: String,
        type: {
            type: String,
            default: 'text'
        },
        value: String
    },
    watch: {
        value() {
            this.content = this.value;
        }
    },
    data() {
        return {
            content: this.value
        }
    },
    methods: {
        changed(event) {
            this.$emit('input', this.content);
        }
    }
}
</script>

<style scoped>

</style>
