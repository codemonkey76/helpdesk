<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-gray-900" v-text="title" />
        <p class="mt-1 max-w-2xl text-sm text-gray-500" v-text="body" />
    </div>
</template>

<script>
export default {
    name: "InfoField",
    props: ['title', 'body']
}
</script>

<style scoped>

</style>
