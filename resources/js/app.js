
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import LiquorTree from 'liquor-tree';
Vue.use(LiquorTree);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('breadcrumb-component', require('./components/BreadcrumbComponent.vue'));
Vue.component('modal-component', require('./components/ModalComponent.vue'));
Vue.component('button-delete-component', require('./components/ButtonDeleteComponent.vue'));
Vue.component('loading-component', require('./components/LoadingComponent.vue'));
Vue.component('select-component', require('./components/SelectComponent.vue'));
Vue.component('check-box-component', require('./components/CheckBoxComponent.vue'));
Vue.component('tree-view-component', require('./components/TreeViewComponent.vue'));
Vue.component('title-page-view-component', require('./components/TitlePageViewComponent.vue'));
Vue.component('search-page-view-component', require('./components/SearchPageViewComponent.vue'));

Vue.prototype.$GlobalEvent = new Vue();


const app = new Vue({
    el: '#app',
    data () {
        return {
            messageTitle: '',
            messageText: '',
            messageType: 0 // 0 - Confirmation 1 - Alert
        }

    },
    methods: {
        onShowLoad: function(){
          console.log('load');
        },
        showModalConfirm: function (title, message, type) {
            this.messageTitle = title;
            this.messageText = message;
            this.messageType = type;

            $('#ModalMessage').modal('toggle');
        }
    }
});

app.$GlobalEvent.$on('show-load', function (value) {
    console.log('logged-in');
    $('#ModalLoading').modal({
        backdrop: 'static',
        keyboard: false
    });
});
