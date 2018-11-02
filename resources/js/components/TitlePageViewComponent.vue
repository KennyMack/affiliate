<template>
    <div class="col col-md-3  col-sm-12 col-12">
        <h4 class="align-bottom title-page">{{ title }}</h4>
    </div>
</template>

<script>
    export default {
        name: "TitlePageViewComponent",
        props: ['title']
    }
</script>

<style scoped>
    .title-page {
        line-height: 50px
    }
</style>
