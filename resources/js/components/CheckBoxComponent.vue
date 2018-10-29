<template>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               :id="name"
               :name="name"
               v-model="checkedbox"
               value="1"
               class="custom-control-input">
        <label class="custom-control-label"
               :for="name">{{ label }}</label>
    </div>
</template>

<script>
    export default {
        name: "CheckBoxComponent",
        props: [
            'label',
            'checkvalue',
            'name',
            'haserror'
        ],
        data() {
            return {
                checkedbox: 0
            }
        },
        created: function(){

            if (this.checkvalue)
                this.checkedbox = parseInt(this.checkvalue);
            else
                this.checkedbox = 0;
        },
    }
</script>

<style scoped>
    /*.haserror {
        border-width: 2px;
        border-color: #e3342f;
    }*/
</style>
