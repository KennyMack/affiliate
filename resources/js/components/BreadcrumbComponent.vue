<template>
    <ol class="breadcrumb">
        <li v-for="(path, index)  in paths"
            class="breadcrumb-item"
            v-bind:class="{ active: index === (paths.length -1)}">
            <a v-if="index !== (paths.length -1)"
               v-bind:href="path.url">{{ path.text }}</a>
            <template v-if="index === (paths.length -1)">{{ path.text }}</template>
        </li>
    </ol>
</template>

<script>
    let urls = [];
    export default {
        data () {
            return {
                paths: urls
            }
        },
        methods: {
            addPath: function(path) {
                if (!path)
                    return;

                if (!isNaN(path))
                    return;

                if (path.toUpperCase() === 'ADMIN')
                    return;

                /*if (urls.indexOf(this.getDescriptionUrl(path)) > -1)
                    return;*/

                if (path.toUpperCase() === 'HOME') {
                    urls.push(this.getDescriptionUrl('home'));
                    return;
                }

                urls.push(this.getDescriptionUrl(path));
            },
            getDescriptionUrl: function (path) {
                switch (path) {
                    case 'home':
                        return {
                            url: window.location.origin,
                            text: 'Home'
                        };
                    case 'countries':
                        return {
                            url: window.location.origin + '/admin/' + path,
                            text: 'País'
                        };
                    case 'create':
                        return {
                            url: '',
                            text: 'Novo'
                        };
                    case 'edit':
                        return {
                            url: '',
                            text: 'Editar'
                        };
                    default:
                        return {
                            url: '',
                            text: 'NÃO ENCONTREI ESSA ' + path
                        };
                }
            }
        },
        created: function () {
            let url = window.location.href;

            if (url) {
                var paths = url.replace('http://', '').replace('https://', '').split('/');
                this.addPath('home');
                if (paths.length > 1)
                {
                    for (let i = 1; i < paths.length; i++) {
                        this.addPath(paths[i]);
                    }
                }
            }
            else
                this.addPath('home');

            console.log(urls);
        } /*,
        ready: function() {
            this.fetchMessages();
        },

        methods: {
            fetchMessages: function() {
                console.log(this.$route.params.slug);
            }
        }*/
        /*mounted()  {
            console.log('BreadcrumbComponent mounted.');
            console.log(this.$route.query.page);
        }*/
    }
</script>
<style scoped>
    .breadcrumb{
        background-color: #ffffff;
        border-radius: 0;
        margin-left: 0;
        margin-bottom: 0;
        margin-top: 0;
        padding-left: 0;
        padding-bottom: 0;
        padding-top: 0;
    }
</style>
