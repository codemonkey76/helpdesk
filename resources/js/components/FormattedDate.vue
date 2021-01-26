<template>
    <span>{{date}}</span>
</template>

<script>
export default {
    props: ['value'],
    computed: {
        date() {
            return this.$moment.utc(this.value).local().fromNow();
        }
    }
}
</script>
