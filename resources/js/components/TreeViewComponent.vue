<template>
    <div >
        <tree class="tree--small tree-view-filter"
              :data="data"
              :options="opts"
              :filter="filter"
              ref="tree"
              @node:checked="onCheckedChanged()">
        </tree>
        <button class="btn btn-primary"
        v-on:click="clickResult()">Result</button>
    </div>
</template>

<script>
    function _get(url, callback) {
        return $.get(window.BASE_URL + url, callback);
    }

    function getType() {
        return window.BASE_URL.indexOf('convidaparcerias') > -1 ? 0 : 1;
    }

    function getData() {
        return new Promise(resolve => {
            _get('/api/categories/main/' + getType(), function (result) {
                console.log('a');
                console.log(result);
                let lst = [];
                result.map(i => {
                    let text = i.name;
                    if (parseInt(i.contagem) > 0)
                        text += '(' + i.contagem + ')';
                    lst.push({
                        text: text,
                        contagem: parseInt(i.contagem),
                        type: i.type,
                        isBatch: parseInt(i.contagem) > 0,
                        id: i.id
                    })
                });

                resolve(lst);
            });
        });
    }

    function getDataChild(id) {
        return new Promise(resolve => {
            _get('/api/categories/' + id + '/child/' + getType(), function (result) {
                console.log('a');
                console.log(result);
                let lst = [];
                result.map(i => {
                    let text = i.name;
                    if (parseInt(i.contagem) > 0)
                        text += '(' + i.contagem + ')';
                    lst.push({
                        text: text,
                        contagem: parseInt(i.contagem),
                        type: i.type,
                        isBatch: parseInt(i.contagem) > 0,
                        id: i.id
                    })
                });

                resolve(lst);
            });
        });
    }
    let key = 0;
    const eventsList = [
       /*{ name: 'tree:mounted', args: ['Tree Component'] },
        { name: 'tree:filtered', args: ['Matches', 'Filter String'] },
        { name: 'tree:data:fetch', args: ['Parent Node'] },
        { name: 'tree:data:received', args: ['Parent Node'] },*/

        /*{ name: 'node:disabled', args: ['Node']},
        { name: 'node:enabled', args: ['Node']},
        { name: 'node:shown', args: ['Node'] },
        { name: 'node:hidden', args: ['Node'] },
        { name: 'node:dblclick', args: ['Node'] },*/
        /*{ name: 'node:selected', args: ['Node'] }, */
        { name: 'node:unselected', args: ['Node'] },
        { name: 'node:checked', args: ['Node'] },
        { name: 'node:unchecked', args: ['Node'] },
        /*{ name: 'node:expanded', args: ['Node'] },
        { name: 'node:collapsed',  args: ['Node'] },
        { name: 'node:added',  args: ['Node', 'New Node'] },
        { name: 'node:removed',  args: ['Node'] },
        { name: 'node:text:changed', args: ['Node', 'New Text', 'Old Text']},

        { name: 'node:editing:start',  args: ['Node'] },
        { name: 'node:editing:stop',  args: ['Node', 'isTextChanged'] },*/
    ];

    export default {
        name: "TreeViewComponent",
        data: () => ({
            events: [],

            data: getData(),
            filter: null,
            opts: {
                minFetchDelay: 1000,
                fetchData: (node) => {
                    return getDataChild(node.id);
                },
                checkbox: true
            }
        }),
        mounted() {
            /*this.$refs.tree.$on('node:checked', this.checked());
            this.$refs.tree.$on('node:unchecked', this.unchecked());*/
            eventsList.forEach(e => {
                this.$refs.tree.$on(e.name, this.initEventViewer(e))
            });
        },
        methods:{
            clickResult() {
                console.clear();
                console.log('Resultado');
                console.log(this.$refs.tree.checked());
                let results = this.$refs.tree.checked();

                results.map(i => {
                   console.log('id: ' + i.id + ' txt: '+ i.data.text);
                });

            },
            onCheckedChanged(){
                //console.log('$event.target');
                //console.log(this.$refs.tree.checked());
            },
            initEventViewer(event) {
                const events = this.events;

                return function (node, newNode) {
                    let nodeText = '-';
                    let targetNode = newNode && newNode.text ? newNode : node;

                    if (targetNode && targetNode.text) {
                        nodeText = targetNode.text;
                    }

                    events.push(
                        Object.assign(
                            {},
                            event,
                            { time: new Date, nodeText, id: key++ }
                        )
                    );

                    //console.log(event, arguments);

                    //console.log(arguments[0].data);
                }
            },
            checked() {
                console.log('checked');
                //console.log(arguments);

            },
            unchecked() {
                console.log('unchecked');
                //console.log(arguments);

            },
        }
    }
</script>

<style scoped>
    .tree-node {
        background: red;
    }
    .tree-view-filter {
        font-size: .8rem;
    }
</style>

