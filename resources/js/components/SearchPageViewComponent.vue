<template>
    <div class="col col-md-9 col-sm-12 col-12">
        <form
            method="GET"
            novalidate
            v-bind:action="url"
            class="form-inline justify-content-end form-search">
            <div class="form-group col-10 form-group-search">
                <input type="text"
                       placeholder="Buscar..." aria-label="Search"
                       class="form-control form-input-search"
                       name="txtsearch"
                       v-model="valsearch"
                       id="txtsearch">
            </div>
            <div class="col-2" >
                <button type="submit" class="btn btn-primary mb-2 form-button-search"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['url', 'valsearch'],
        name: "SearchPageViewComponent"
    }
</script>

<style scoped>
    .form-search {
        width: 71%;
        margin-left: 30%
    }
    .form-group-search {
        margin-right: 0;
        padding-right: 0;
    }
    .form-input-search {
        width: 100%;
    }
    .form-button-search {
        margin-top: 7px;
    }
</style>
