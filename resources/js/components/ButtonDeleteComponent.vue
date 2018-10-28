<template>
    <div>
        <!--<button class="btn btn-danger btn-icon"
                @click="showForm('Exclusão', 'Confirma a exclusão do registro ?', 0)">
            <i class="fas fa-trash-alt"></i>
        </button>-->

        <form style="display: inline;"
              method="POST"
              id="frm-delete"
              @submit.prevent="showForm('Exclusão', 'Confirma a exclusão do registro ?', 0, $event)"
              v-bind:action="url">
            <input name="_method" type="hidden" value="DELETE">
            <input type="hidden" name="_token" v-bind:value="csrfval">
            <button
                type="submit"
                class="btn btn-danger btn-icon">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>

        <modal-component
            :title-message="TitleMessage"
            :text-message="TextMessage"
            :type-message="TypeMessage"
            v-on:onNoClick="onNoClick"
            v-on:onYesClick="onYesClick"
        ></modal-component>
    </div>
</template>

<script>
    let confirmed = false;
    export default {
        props: ['registerId', 'url' ],
        name: "ButtonDeleteComponent",
        data () {
            return {
                csrfval: '',
                TitleMessage: '',//'Exclusão',
                TextMessage: '',//'Confirma a exclusão do registro ?',
                TypeMessage: 0 // 0 - Confirmation 1 - Alert
            }
        },
        created: function(){
            confirmed = false;
        },
        methods: {
            showForm: function(title, message, type, e) {
                if (!confirmed) {
                    this.TitleMessage = title;

                    this.TextMessage = message;
                    this.TypeMessage = type;
                    console.log(this.TextMessage);
                    console.log(e);
                    this.csrfval = document.getElementsByName('_token')[0].value;
                    $('#ModalMessage').modal('toggle');
                    e.preventDefault();
                }
            },
            onNoClick(){
            },
            onYesClick(){
                confirmed = true;
                document.getElementById("frm-delete").submit();
                this.$GlobalEvent.$emit('show-load', true);
            }
        }
    }
</script>

<style scoped>

</style>
