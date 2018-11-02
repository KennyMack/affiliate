<template>
    <a class="btn btn-basic btn-icon"
             v-bind:href="url">
        <i style="color:#333" class="fas fa-pencil-alt"></i>
    </a>
    
</template>

<script>
    export default {
        props: ['url'],
        name: "ButtonEditComponent"
    }
</script>

<style scoped>

</style>
