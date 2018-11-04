<template>
    <div class="modal-back" id="ModalLoading"
         tabindex="-1" role="dialog"
         aria-labelledby="ModalLoading" >
        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
    </div>
</template>

<script>
    export default {
        name: "LoadingComponent"
    }
</script>

<style scoped>
    .modal-back {
        display:none;
        position: fixed;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,.7);
        /*background: rgba(18,18,18, .8);
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;*/
        z-index: 9999;
    }

    .lds-ring {
        display: inline-block;
        position: absolute;
        left: 50%;
        top: 50%;
        margin-top: -32px;
        margin-left: -32px;
        width: 64px;
        height: 64px;
    }
    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 51px;
        height: 51px;
        margin: 6px;
        border: 6px solid #fff;
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: #fff transparent transparent transparent;
    }
    .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }
    .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }
    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }
    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
