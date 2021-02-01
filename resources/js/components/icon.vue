<template>
    <i :class="iconClass"></i>
</template>
<script>
export default {
    props: {
        name: String,
        type: {
            type: String,
            default: 'fas'
        }
    },
    computed: {
        iconClass() {
            return this.type + ' fa-' + this.name;
        }
    }
}
</script>
