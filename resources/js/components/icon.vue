<template>
    <i class="fas" :class="'fa-' + name"></i>
</template>
<script>
export default {
    props: ['name']
}
</script>
