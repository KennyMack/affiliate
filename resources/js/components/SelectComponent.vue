<template>
    <select class="form-control"
            :id="name"
            :name="name"
            v-bind:class="{ haserror: haserror}">
        <option value="-1">Selecione...</option>
        <option v-for="item in itemsData"
                v-bind:value="item[keyval]"
                v-bind:selected="item[keyval].toString() === value.toString()">
            {{ item[descval] }}
        </option>
    </select>
</template>

<script>
    export default {
        data () {
            return {
                itemsData: JSON.parse(this.items)
            }
        },
        props: [
            'selectfirst',
            'items',
            'value',
            'name',
            'cannull',
            'keyval',
            'descval',
            'haserror'
        ],
        mounted() {
        }
    }
</script>

<style scoped>
    .haserror {
        border-width: 2px;
        border-color: #e3342f;
    }
</style>
