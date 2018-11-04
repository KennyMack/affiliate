<template>
    <select class="form-control"
            :id="name"
            :name="name"
            @change="onChange($event)"
            v-model="selectedValue"
            v-bind:class="{ haserror: haserror}">
        <option value="-1">Selecione...</option>
        <option v-for="item in itemsData"
                :data-tag="getValue(item)"
                v-bind:value="item[keyval]">
            {{ item[descval] }}
        </option>
    </select>
</template>

<script>
    /**
     <option v-for="item in itemsData"
     v-bind:value="item[keyval]"
     v-bind:selected="item[keyval].toString() === value.toString()">
     {{ item[descval] }}
     </option>

     */

    export default {
        data () {
            return {
                itemsData: JSON.parse(this.items),
                selectedValue: -1
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
        methods: {
            onChange(evt) {
                this.$emit('onSelectChanged', {
                    value: this.selectedValue,
                    event: evt
                });
            },
            getValue(item){
                return JSON.stringify(item);
            }
        },
        created() {
            this.selectedValue = this.value || -1;
        },
        mounted() {
        },
        watch: {
            items: function (newVal) {
                this.itemsData = JSON.parse(newVal);
            },
            value: function (newVal) {
                this.value = newVal;
                this.selectedValue = this.value;
            }
        }
    }
</script>

<style scoped>
    .haserror {
        border-width: 2px;
        border-color: #e3342f;
    }
</style>
