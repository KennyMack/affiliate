<template>
    <div class="modal fade" id="ModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ titleMessage }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ textMessage }}
                </div>
                <div class="modal-footer"
                     v-if="typeMessage === 0">
                    <button type="button" class="btn btn-primary"
                        @click="onYesClick()">Sim</button>
                    <button type="button" class="btn btn-basic"
                            @click="onNoClick()">Não</button>
                </div>
                <div class="modal-footer"
                     v-if="typeMessage === 1">
                    <button type="button" class="btn btn-primary"
                            @click="onOKClick()">OK</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['titleMessage', 'textMessage', 'typeMessage'],
        name: "ModalComponent",
        methods: {
            onNoClick(){
                this.$emit('onNoClick', false);
                $('#ModalMessage').modal('toggle');
            },
            onYesClick(){
                this.$emit('onYesClick', true);
                $('#ModalMessage').modal('toggle');
            },
            onOKClick() {
                this.$emit('onOKClick', true);
                $('#ModalMessage').modal('toggle');
            }
        }
    }
</script>

<style scoped>

</style>
