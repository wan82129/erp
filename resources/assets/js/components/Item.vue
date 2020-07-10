<template>
    <div class="container-fluid">
        <div class="card m-2" v-if="isTableReady">
            <div class="card-header font-weight-bold">{{ headerTitle }}</div>
            <div class="card-body">
                <div class="d-flex">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" @click="initAddModal()">
                            新增
                        </button>
                    </div>
                    <div class="form-group ml-auto">
                        <input type="text" class="form-control" placeholder="搜尋" v-model="filter">
                    </div>
                </div>
                <b-table striped hover :items="items" :fields="fields" :filter="filter" :current-page="currentPage" :per-page="perPage" @filtered="onFiltered">
                    <template v-slot:cell(Actions)="row">
                        <b-button class="btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg" @click="initEditModal(row.item)">
                            修改
                        </b-button>
                        <b-button class="btn-danger">
                            移除
                        </b-button>
                    </template>
                </b-table>
                <div class="d-flex">
                    <div class="ml-auto">
                        <b-pagination
                            v-model="currentPage"
                            :total-rows="totalRows"
                            :per-page="perPage"
                            align="fill">
                        </b-pagination>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center m-3" v-else>
            <div class="spinner-border" style="width: 10rem; height: 10rem;">
            </div>
        </div>

        <div class="modal bd-example-modal-lg" tabindex="-1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div v-if="isModalReady">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold">{{ modalTitle }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" ref="modalClose">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form v-if="type === GLOBAL.SERVICE_STAFF">
                                <div class="form-group">
                                    <label class="col-form-label">員工代號</label>
                                    <input type="text" class="form-control" v-model="item.Code">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">員工名稱</label>
                                    <input type="text" class="form-control" v-model="item.Name">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">員工簡稱</label>
                                    <input type="text" class="form-control" v-model="item.NickName">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">身分證號</label>
                                    <input type="text" class="form-control" v-model="item.SerialNumber">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">職務</label>
                                    <select class="form-control" v-model="item.AccessLevelId">
                                        <option v-for="staffAccessLevel in staffAccessLevels" v-bind:value="staffAccessLevel.Id">{{ staffAccessLevel.Text }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">電話</label>
                                    <input type="text" class="form-control" v-model="item.Phone">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">生日</label>
                                    <input type="date" class="form-control" v-model="item.Birthday">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">在職</label>
                                    <select class="form-control" v-model="item.IsActive">
                                        <option>是</option>
                                        <option>否</option>
                                    </select>
                                </div>
                            </form>
                            
                            <form v-if="type === GLOBAL.SERVICE_ROOM">
                            </form>

                            <form v-if="type === GLOBAL.SERVICE_FOOD">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary" @click="operateItem()" v-if="isItemApiReady">確認</button>
                            <b-button variant="primary" disabled v-else>
                                <b-spinner small></b-spinner>
                            </b-button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center m-3" v-else>
                        <div class="spinner-border" style="width: 5rem; height: 5rem;">
                    </div>
                </div>
            </div>
        </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                type: '',

                fields: [],
                items: [],
                item: {},

                filter: '',

                totalRows: '',
                currentPage: '',
                perPage: '',

                staffAccessLevels: [],
                staffAccessLevel: {
                    Id: '',
                    Text: ''
                },

                headerTitle: '',
                modalTitle: '',
                modalActionAdd: 'add',
                modalActionEdit: 'edit',
                modalAction: '',

                getItemsUrl: '',
                addItemUrl: '',
                editItemUrl: '',
                getStaffAccessLevelUrl: '',

                isTableReady: false,
                isModalReady: false,
                isItemApiReady: true
            }
        },
        methods: {
            init() {
                //頁面載入完成
                this.isTableReady = false;
                //跳窗載入完成
                this.isModalReady = false;
                //ITEM操作API按鈕是否可按
                this.isItemApiReady = true;

                //取得StaffAccessLevel的API
                this.getStaffAccessLevelUrl = '/api/staffAccessLevel';

                //目前頁面種類，覺得title和取得資料的api
                this.type = this.$route.params.type;
                if (this.type == this.GLOBAL.SERVICE_STAFF) {
                    this.headerTitle = '員工資料';
                } 
                if (this.type == this.GLOBAL.SERVICE_ROOM) {
                    this.headerTitle = '包廂資料';
                }
                if (this.type == this.GLOBAL.SERVICE_FOOD) {
                    this.headerTitle = '餐點資料';
                }
                this.getItemsUrl = '/api/' + this.type;
                this.addItemUrl = '/api/' + this.type;
                this.editItemUrl = '/api/' + this.type;

                //初始化表格欄位
                this.initFields();

                //初始化資料
                this.items= [];
                this.initItem();

                //取得資料並渲染在頁面上
                let self = this;
                axios.get(this.getItemsUrl).then(function (response) {
                    self.items = response.data.data;

                    self.filter = '';
                    self.totalRows = self.items.length;
                    self.currentPage = 1;
                    self.perPage = 20;

                    self.isTableReady = true;
                }).catch(function (response) {
                    console.log(response);
                });
            },
            initFields() {
                this.fields = [];
                if (this.type == this.GLOBAL.SERVICE_STAFF) {
                    this.fields = [
                        {
                            key: 'Code',
                            label: '代號',
                            sortable: true
                        },
                        {
                            key: 'Name',
                            label: '名稱',
                            sortable: true
                        },
                        {
                            key: 'NickName',
                            label: '簡稱'
                        },
                        {
                            key: 'SerialNumber',
                            label: '身分證'
                        },
                        {
                            key: 'AccessLevelText',
                            label: '職務'
                        },
                        {
                            key: 'Phone',
                            label: '電話'
                        },
                        {
                            key: 'Birthday',
                            label: '生日'
                        },
                        {
                            key: 'IsActive',
                            label: '在職'
                        },
                        {
                            key: 'Actions',
                            label: '操作'
                        }
                    ];
                }
                if (this.type == this.GLOBAL.SERVICE_ROOM) {
                    this.fields = [
                        {
                            key: 'Code',
                            label: '包廂代號',
                            sortable: true
                        },
                        {
                            key: 'Actions',
                            label: '操作'
                        }
                    ];
                }
                if (this.type == this.GLOBAL.SERVICE_FOOD) {
                    this.fields = [
                        {
                            key: 'Code',
                            label: '餐點代號',
                            sortable: true
                        },
                        {
                            key: 'Actions',
                            label: '操作'
                        }
                    ];
                }
            },
            initItem() {
                this.item = {};
                if (this.type == this.GLOBAL.SERVICE_STAFF) {
                    this.item = {
                        Id: '',
                        Code: '',
                        Name: '',
                        NickName: '',
                        SerialNumber: '',
                        AccessLevelId: '',
                        AccessLevelText: '',
                        Phone: '',
                        Birthday: '',
                        IsActive: ''
                    }
                }
            },
            initStaffAccessLevel() {
                this.staffAccessLevel = {
                    Id: '',
                    Text: ''
                }
            },
            initAddModal() {
                //reset modal status
                this.isModalReady = false;

                //setting modal action
                this.modalAction = this.modalActionAdd;

                //ITEM操作API按鈕是否可按
                this.isItemApiReady = true;

                //reset modal data
                this.initItem();

                //set modal title
                this.modalTitle = '新增';

                if (this.type == this.GLOBAL.SERVICE_STAFF) {
                    this.modalTitle += '員工';

                    //reset staff access level
                    this.initStaffAccessLevel();

                    let self = this;
                    axios.get(this.getStaffAccessLevelUrl).then(function (response) {
                        self.staffAccessLevels = response.data.data;

                        self.isModalReady = true;
                    }).catch(function (response) {
                        console.log(response);
                    });
                }
                
                if (this.type == this.GLOBAL.SERVICE_ROOM) {
                    this.modalTitle += '包廂';

                    this.isModalReady = true;
                }
                
                if (this.type == this.GLOBAL.SERVICE_FOOD) {
                    this.modalTitle += '餐點';

                    this.isModalReady = true;
                }
            },
            initEditModal(item) {
                //reset modal status
                this.isModalReady = false;

                //setting modal action
                this.modalAction = this.modalActionEdit;

                //ITEM操作API按鈕是否可按
                this.isItemApiReady = true;

                //reset modal data
                this.initItem();

                //set modal title
                this.modalTitle = '編輯';

                if (this.type == this.GLOBAL.SERVICE_STAFF) {
                    this.modalTitle += '員工';

                    //reset staff access level
                    this.initStaffAccessLevel();

                    //acquire staff access level though backend API
                    let self = this;
                    axios.get(this.getStaffAccessLevelUrl).then(function (response) {
                        self.staffAccessLevels = response.data.data;

                        self.isModalReady = true;
                    }).catch(function (response) {
                        console.log(response);
                    });

                    //acquire selected data
                    this.item = item;
                }
            },
            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            operateItem() {
                this.isItemApiReady = false;

                let self = this;
                if (this.modalAction == this.modalActionAdd) {
                    axios.post(this.addItemUrl, this.item).then(function (response) {
                        if (response.data.data == true) {
                            self.$refs['modalClose'].click();
                            self.init();
                        }
                        else {
                            self.isItemApiReady = true;
                        }
                    }).catch(function (response) {
                        self.isItemApiReady = true;
                    });
                }
                if (this.modalAction == this.modalActionEdit) {
                    axios.put(this.editItemUrl, this.item).then(function (response) {
                        if (response.data.data == true) {
                            self.$refs['modalClose'].click();
                            self.init();
                        }
                        else {
                            self.isItemApiReady = true;
                        }
                    }).catch(function (response) {
                        self.isItemApiReady = true;
                    });
                }
            }
        },
        watch: {
            '$route.params.type': function(newVal, oldVal){
                this.init();
            }
        },
        mounted() {
            this.init();
        }
    }
</script>
