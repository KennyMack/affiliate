<template>
    <div class="container-center">

        <div class="container-center">
            <div class="row">
                <div class="col col-12">
                    <div class="box-image">

                        <input type="hidden"
                               ref="imgdata"
                               name="imgdata"
                               id="imgdata"
                               v-model="imgdata"/>

                        <input type="hidden"
                               name="imgchanged"
                               id="imgchanged"
                               v-model="imgchanged"/>

                        <label class="labelimage" for="inputimage">
                            <img style="max-width: 200px"
                                 :src="imgprefill"
                                 alt="..."
                                 class="img-thumbnail rounded mx-auto d-block">
                        </label>
                        <input class="inputfile"
                               v-on:change="onSelectedImage"
                               name="inputimage"
                               id="inputimage"
                               type="file" />
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>

        <div class="form-group row">

            <label for="companyname" class="col-md-4 col-form-label text-md-right">{{ labelData['companyname'] }}</label>

            <div class="col-md-5">
                <input id="companyname"
                       type="text"
                       v-bind:class="{ 'is-invalid': fieldHasErrors('companyname')}"
                       class="form-control"
                       name="companyname"
                       v-model="companyname"
                       required
                       autofocus>
                <span v-if="fieldHasErrors('companyname')"
                      class="invalid-feedback" role="alert">
                    <strong>{{ firstError('companyname') }}</strong>
                </span>

            </div>
        </div>

        <div class="form-group row">

            <label for="cnpjcpf" class="col-md-4 col-form-label text-md-right">{{ labelData['cnpjcpf'] }}</label>

            <div class="col-md-5">
                <the-mask id="cnpjcpf"
                          type="text"
                          v-bind:class="{ 'is-invalid': fieldHasErrors('cnpjcpf')}"
                          masked="true"
                          class="form-control"
                          name="cnpjcpf"
                          v-model="cnpjcpf"
                          :mask="['###.###.###-##', '##.###.###/####-##']"
                          :masked="true"
                          required />
                <span v-if="fieldHasErrors('cnpjcpf')"
                      class="invalid-feedback" role="alert">
                    <strong>{{ firstError('cnpjcpf') }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">

            <label for="postalnumber" class="col-md-4 col-form-label text-md-right">{{ labelData['postalnumber'] }}</label>

            <div class="col-md-5">
                <input id="postalnumber"
                       type="text"
                       v-bind:class="{ 'is-invalid': fieldHasErrors('postalnumber')}"
                       class="form-control"
                       name="postalnumber"
                       v-focus="focusedCEP"
                       @focus="focusedCEP = true"
                       @blur="focusedCEP = false"
                       v-on:change="onCEPChanged($event)"
                       v-model="postalnumber"
                       v-mask="'#####-###'"
                       required>
                <span v-if="fieldHasErrors('postalnumber')"
                      class="invalid-feedback" role="alert">
                    <strong>{{ firstError('postalnumber') }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="state_id"
                   class="col-md-4 col-form-label text-md-right">{{ labelData['state_id'] }}</label>

            <div class="col-md-5">
                <select-component
                    selectfirst="false"
                    v-bind:items="statesData"
                    v-bind:value="state_id"
                    name="state_id"
                    id="state_id"
                    cannull="2"
                    keyval="id"
                    descval="name"
                    @onSelectChanged="onSelectChanged"
                    :haserror="fieldHasErrors('state_id')"
                >
                </select-component>
                <span v-if="fieldHasErrors('state_id')"
                      class="help-block">
                    <strong>Selecione um estado.</strong>
                </span>
            </div>

        </div>

        <div class="form-group row">
            <label for="city_id"
                   class="col-md-4 col-form-label text-md-right">{{ labelData['city_id'] }}</label>

            <div class="col-md-5">
                <select-component
                    selectfirst="false"
                    v-bind:items="citiesData"
                    v-bind:value="city_id"
                    id="city_id"
                    name="city_id"
                    cannull="2"
                    keyval="id"
                    descval="name"
                    :haserror="fieldHasErrors('city_id')"
                >
                </select-component>
                <span v-if="fieldHasErrors('city_id')"
                      class="help-block">
                    <strong>Selecione uma cidade.</strong>
                </span>
            </div>

        </div>

        <div class="form-group row">

            <label for="street" class="col-md-4 col-form-label text-md-right">{{ labelData['street'] }}</label>

            <div class="col-md-5">
                <input id="street"
                       type="text"
                       v-bind:class="{ 'is-invalid': fieldHasErrors('street')}"
                       class="form-control"
                       name="street"
                       v-model="street"
                       required>
                <span v-if="fieldHasErrors('street')"
                      class="invalid-feedback" role="alert">
                    <strong>{{ firstError('street') }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">

            <label for="district" class="col-md-4 col-form-label text-md-right">{{ labelData['district'] }}</label>

            <div class="col-md-5">
                <input id="district"
                       type="text"
                       v-bind:class="{ 'is-invalid': fieldHasErrors('district')}"
                       class="form-control"
                       name="district"
                       v-model="district"
                       required>
                <span v-if="fieldHasErrors('district')"
                      class="invalid-feedback" role="alert">
                    <strong>{{ firstError('district') }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">

            <label for="number" class="col-md-4 col-form-label text-md-right">{{ labelData['number'] }}</label>

            <div class="col-md-5">
                <input id="number"
                       type="text"
                       v-bind:class="{ 'is-invalid': fieldHasErrors('number')}"
                       class="form-control"
                       name="number"
                       v-model="number"
                       required>
                <span v-if="fieldHasErrors('number')"
                      class="invalid-feedback" role="alert">
                    <strong>{{ firstError('number') }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">

            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ labelData['phone'] }}</label>

            <div class="col-md-5">
                <the-mask id="phone"
                          type="text"
                          v-bind:class="{ 'is-invalid': fieldHasErrors('phone')}"
                          class="form-control"
                          name="phone"
                          v-model="phone"
                          :mask="['(##) ####-####', '(##) #####-####']"
                          :masked="true"
                          required />
                <span v-if="fieldHasErrors('phone')"
                      class="invalid-feedback" role="alert">
                    <strong>{{ firstError('phone') }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="category_type"
                   class="col-md-4 col-form-label text-md-right">{{ labelData['category_type'] }}</label>

            <div class="col-md-5">
                <select-component
                    selectfirst="false"
                    items='[{ "id":0, "name": "Convida" },{ "id":1, "name": "Clube de Vantagens" },{ "id":2, "name": "Convida/Clube de Vantagens" }]'
                    v-bind:value="category_type"
                    name="category_type"
                    id="category_type"
                    cannull="2"
                    keyval="id"
                    descval="name"
                    @onSelectChanged="onTypeCategoryChanged"
                    :haserror="fieldHasErrors('category_type')"
                >
                </select-component>
                <span v-if="fieldHasErrors('category_type')"
                      class="help-block">
                    <strong>Selecione um tipo.</strong>
                </span>
            </div>

        </div>

        <div class="form-group row">
            <label for="category_id"
                   class="col-md-4 col-form-label text-md-right">{{ labelData['category_id'] }}</label>

            <div class="col-md-5">
                <select-component
                    selectfirst="false"
                    v-bind:items="categoryData"
                    v-bind:value="category_id"
                    name="category_id"
                    id="category_id"
                    cannull="2"
                    keyval="id"
                    descval="name"
                    @onSelectChanged="onMainCategoryChanged"
                    :haserror="fieldHasErrors('category_id')"
                >
                </select-component>
                <span v-if="fieldHasErrors('category_id')"
                      class="help-block">
                    <strong>Selecione uma categoria.</strong>
                </span>
            </div>

        </div>

        <div class="form-group row">
            <label for="expertise_id"
                   class="col-md-4 col-form-label text-md-right">{{ labelData['expertise_id'] }}</label>

            <div class="col-md-5">
                <select-component
                    selectfirst="false"
                    v-bind:items="expertiseData"
                    v-bind:value="expertise_id"
                    name="expertise_id"
                    id="expertise_id"
                    cannull="2"
                    keyval="id"
                    descval="name"
                    :haserror="fieldHasErrors('expertise_id')"
                >
                </select-component>
                <span v-if="fieldHasErrors('expertise_id')"
                      class="help-block">
                    <strong>Selecione uma especialidade.</strong>
                </span>
            </div>

        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">{{ labelData['company_period'] }}</label>

            <div class="col-md-2">
                <input id="starttime"
                       type="text"
                       v-bind:class="{ 'is-invalid': fieldHasErrors('starttime')}"
                       class="form-control"
                       name="starttime"
                       v-model="hourstart"
                       v-mask="'##:##'"
                       required>
                <span v-if="fieldHasErrors('starttime')"
                      class="invalid-feedback" role="alert">
                    <strong>{{ firstError('starttime') }}</strong>
                </span>
            </div>
            <label class="col-md-1 col-form-label">às</label>
            <div class="col-md-2">
                <input id="endtime"
                       type="text"
                       v-bind:class="{ 'is-invalid': fieldHasErrors('endtime')}"
                       class="form-control"
                       name="endtime"
                       v-mask="'##:##'"
                       v-model="hourend"
                       required>
                <span v-if="fieldHasErrors('endtime')"
                      class="invalid-feedback" role="alert">
                    <strong>{{ firstError('endtime') }}</strong>
                </span>
            </div>

        </div>

        <div class="form-group row">

            <label for="details" class="col-md-4 col-form-label text-md-right">{{ labelData['details'] }}</label>

            <div class="col-md-5">
                <textarea-autosize
                    class="form-control"
                    ref="details"
                    v-model="details"
                    name="details"
                    id="details"
                    :min-height="30"
                    :max-height="350"
                ></textarea-autosize>
                <span v-if="fieldHasErrors('details')"
                      class="invalid-feedback" role="alert">
                    <strong>{{ firstError('details') }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-4">
                &nbsp;
            </div>
            <div class="col-md-5">
                <input type="hidden"
                       name="status"
                       value="0"/>
                <check-box-component
                    v-bind:label="labelData['status']"
                    v-bind:checkvalue="status"
                    name="status"
                    :haserror="fieldHasErrors('status')">
                </check-box-component>
                <span v-if="fieldHasErrors('status')" class="help-block">
                    <strong>{{ firstError('status') }}</strong>
                </span>
            </div>

        </div>
    </div>
</template>

<script>
    import { focus } from 'vue-focus';
    import { mask } from 'vue-the-mask';
    import PictureInput from 'vue-picture-input';

    function _get(url, callback) {
        return $.get(window.BASE_URL + url, callback);
    }

    export default {
        components: {
            PictureInput
        },
        directives: {
            focus: focus,
            mask: mask
        },
        props: [
            'company',
            'states',
            'labels',
            'idstate',
            'categorytype',
            'imagesearch',
            'imagetemp',
            'image',
            'errors',
            'old'
        ],
        name: "CompanyFormComponent",
        data() {
            return {
                statesData: JSON.parse(this.states),
                errorsData: JSON.parse(this.errors),
                labelData: JSON.parse(this.labels),
                companyData: JSON.parse(this.company),
                categoryData: "[]",
                expertiseData: "[]",
                id_state: this.idstate,
                oldData: JSON.parse(this.old),
                category_type: this.categorytype,
                citiesData: "[]",
                companyname: '',
                cnpjcpf: '',
                status: 1, // 0- inativo 1- ativo
                state_id: -1,
                city_id: -1,
                street: '',
                district: '',
                number: '',
                postalnumber: '',
                phone: '',
                // area de ocupação
                category_id: -1,
                // especialidade
                expertise_id: -1,
                details: '',
                starttime: null,
                endtime: null,
                focusedCEP: false,
                hasCEP: false,
                hourstart: '',
                hourend: '',
                imgdata: '',
                imgprefill: '',
                imgchanged: '0'
            }
        },
        methods: {
            fieldHasErrors: function (str) {
                return this.errorsData.hasOwnProperty(str);
            },
            firstError: function (str) {
                return this.errorsData[str][0];
            },
            getOldValue: function (str) {
                return this.oldData[str];
            },
            getFieldValue: function (str) {
                return this.companyData[str];
            },
            getLastValue: function (str, def) {
                return this.getOldValue(str) || this.getFieldValue(str) || def;
            },
            onTypeCategoryChanged: function (val, show = true) {
                if (show)
                    this.$GlobalEvent.$emit('show-load', true);
                let self = this;
                this.categoryData = "[]";
                this.category_id = -1;
                this.expertiseData = "[]";
                this.expertise_id = -1;
                this.category_type = val.value;
                this.getMainCategory(val.value)
                    .then(function (result) {
                        self.categoryData = JSON.stringify(result);
                        if (show)
                            self.$GlobalEvent.$emit('show-load', false);
                    })
                    .catch(() => {
                        if (show)
                            self.$GlobalEvent.$emit('show-load', false);
                    });

            },
            onMainCategoryChanged: function (val, show = true) {
                if (show)
                    this.$GlobalEvent.$emit('show-load', true);

                this.expertiseData = "[]";
                this.expertise_id = -1;
                let self = this;
                this.getChildCategory(this.category_type, val.value)
                    .then(function (result) {
                        self.expertiseData = JSON.stringify(result);
                        if (show)
                            self.$GlobalEvent.$emit('show-load', false);
                    })
                    .catch(() => {
                        if (show)
                            self.$GlobalEvent.$emit('show-load', false);
                    });
            },
            onSelectChanged: function (val, show = true) {
                if (show)
                    this.$GlobalEvent.$emit('show-load', true);
                let self = this;
                this.getCities(val.value)
                    .then(function (result) {
                        self.citiesData = JSON.stringify(result);
                        if (show)
                            self.$GlobalEvent.$emit('show-load', false);
                    })
                    .catch(() => {
                        if (show)
                            self.$GlobalEvent.$emit('show-load', false);
                    });

            },
            getCities(id) {
                return new Promise(function (resolve, reject) {
                    _get('/api/states/' + id + '/cities', result => resolve(result));
                });
            },
            onCEPChanged(evt) {
                this.hasCEP = false;
            },
            getCEP(postalnumber) {
                this.$GlobalEvent.$emit('show-load', true);
                return new Promise(function (resolve, reject) {
                    try {
                        $.getJSON("https://viacep.com.br/ws/" + postalnumber + "/json")
                            .done(function (result) {
                                resolve(result)
                            })
                            .fail(function (jqxhr, textStatus, error) {
                                reject()
                            });
                    }
                    catch (e) {

                    }
                });
            },
            getMainCategory(type) {
                return new Promise(function (resolve, reject) {
                    _get('/api/categories/main/' + type,
                        result => resolve(result),
                        () => reject()
                    );
                });
            },
            getChildCategory(type, id) {
                return new Promise(function (resolve, reject) {
                    _get('/api/categories/' + id + '/child/' + type,
                        result => resolve(result),
                        () => reject()
                    );
                });
            },
            timeToInt(t) {
                var arr = t.split(':');
                var dec = parseInt((arr[1] / 6) * 10, 10);

                return Math.ceil((parseFloat(parseInt(arr[0], 10) + '.' + (dec < 10 ? '0' : '') + dec)) * 60);
            },
            intToTime(num) {
                var hours = Math.floor(num / 60);
                var minutes = num % 60;
                return hours.toString().padStart(2, '0') + ":" + minutes.toString().padStart(2, '0');
            },
            readURL: function (input, img, inputData) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        img.attr('src', e.target.result);
                        inputData.val(e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            },
            onSelectedImage: function (e) {
                if (e.target.files && e.target.files.length > 0 &&
                    e.target.files[0]) {
                    var reader = new FileReader();
                    let self = this;
                    reader.onload = function (e) {

                        self.imgprefill = e.target.result;
                        self.imgdata = e.target.result;
                        self.imgchanged = '1';
                    };

                    reader.readAsDataURL(e.target.files[0]);
                }
            }
        },
        created() {
            this.$GlobalEvent.$emit('show-load', true);
            let ret = [];
            let st = JSON.parse(this.states);
            st.map(function (r) {
                let l = r;
                l.name = r.name + ' (' + r.initials + ')';
                ret.push(l);
            });
            this.statesData = JSON.stringify(ret);



            if (this.imagetemp != null && this.imagetemp != '') {
                this.imgdata = this.imagetemp;
                this.imgchanged = '1';
            }
            else if (this.imagetemp == null || this.imagetemp == '' &&
                this.image != null && this.image != '')
                this.imgdata = this.image;

            if (this.imgdata != null && this.imgdata != '')
                this.imgprefill = this.imgdata;
            else
                this.imgprefill = this.imagesearch;

            this.companyname = this.getLastValue('companyname', '');
            this.cnpjcpf = this.getLastValue('cnpjcpf', '');
            this.status = this.getLastValue('status', 1);
            this.state_id = this.getLastValue('state_id', -1);
            if (this.state_id == -1 || this.state_id == null) {
                this.state_id = this.id_state;
            }

            if (this.state_id != -1 && this.state_id != null) {
                this.onSelectChanged({
                    value: this.state_id
                }, false);
            }
            this.$GlobalEvent.$emit('show-load', true);
            this.city_id = this.getLastValue('city_id', -1);
            this.street = this.getLastValue('street', '');
            this.district = this.getLastValue('district', '');
            this.number = this.getLastValue('number', '');
            this.postalnumber = this.getLastValue('postalnumber', '');
            this.phone = this.getLastValue('phone', '');
            this.category_type = this.getLastValue('category_type', -1);
            if (this.category_type == -1 || this.category_type == null) {
                this.category_type = this.categorytype;
            }

            if (this.category_type != -1 && this.category_type != null) {
                this.onTypeCategoryChanged({
                    value: this.category_type
                }, false);
            }


            this.category_id = this.getLastValue('category_id', -1);

            if (this.category_id != -1 && this.category_id != null) {
                this.onMainCategoryChanged({
                    value: this.category_id
                }, false);
            }

            this.expertise_id = this.getLastValue('expertise_id', -1);
            this.details = this.getLastValue('details', '');
            this.starttime = this.getLastValue('starttime', null);
            this.hourstart = this.starttime != null ? this.intToTime(this.starttime) : '';

            this.endtime = this.getLastValue('endtime', null);

            this.hourend = this.endtime != null ? this.intToTime(this.endtime) : '';


            this.hasCEP = true;
            let timerId = window.setTimeout(() => {
                //this.$GlobalEvent.$emit('show-load', false);
                clearTimeout(timerId);
            }, 3000);

        },
        watch: {
            focusedCEP: function (newVal) {
                let self = this;
                if (!newVal && !self.hasCEP) {
                    self.hasCEP = true;
                    self.getCEP(this.postalnumber)
                        .then(function (result) {
                            self.$GlobalEvent.$emit('show-load', true);
                            self.street = result.logradouro;
                            self.district = result.bairro;
                            let findState = false;
                            let statesItens = JSON.parse(self.statesData);
                            for (let i = 0; i < statesItens.length; i++) {
                                let state = statesItens[i];

                                if (state.initials.toUpperCase() ==
                                    result.uf.toString().toUpperCase()) {
                                    self.state_id = state.id;
                                    findState = true;
                                    self.onSelectChanged({
                                        value: self.state_id
                                    }, false);
                                    break;
                                }
                            }

                            $('#city_id').focus();
                            if (findState) {
                                self.$GlobalEvent.$emit('show-load', true);
                                let timerId = window.setTimeout(() => {
                                    let citiesItens = JSON.parse(self.citiesData);
                                    for (let i = 0; i < citiesItens.length; i++) {
                                        let city = citiesItens[i];

                                        if (city.ibge.toUpperCase() ==
                                            result.ibge.toString().toUpperCase()) {
                                            self.city_id = city.id;
                                            $('#number').focus();
                                            break;
                                        }
                                    }
                                    self.$GlobalEvent.$emit('show-load', false);
                                    clearTimeout(timerId);

                                }, 3000);
                            }
                            else
                                self.$GlobalEvent.$emit('show-load', false);

                        })
                        .catch(() => {
                            $('#state_id').focus();
                            self.state_id = -1;
                            self.city_id = -1;
                            self.citiesData = "[]";

                            self.$GlobalEvent.$emit('show-load', false);
                        });
                }
            },
            hourstart: function (newVal) {
                this.starttime = this.timeToInt(newVal);
            },
            hourend: function (newVal) {
                this.endtime = this.timeToInt(newVal);
            }
        }
    }
</script>

<style scoped>
    .box-image {
        max-width: 200px;
        margin: 0 auto;
    }
    .labelimage {
        cursor: pointer;
        margin: 0 auto;
        display: inline;
    }
    .inputfile {
        display: none!important;
    }
    .picture-inner{
        border: none;
    }
    .picture-preview {
        background: rgba(200,200,200,.25);
        border: none;
    }
</style>
