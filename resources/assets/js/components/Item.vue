<template>
    <div class="container-fluid">
        <div class="card m-2" v-if="isTableReady">
            <div class="card-header font-weight-bold">{{ headerTitle }}</div>
            <div class="card-body">
                <div class="d-flex">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#operateModal" @click="initAddModal()">
                            新增
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exportModal" @click="initExportModal()">
                            匯出
                        </button>
                    </div>
                    <div class="form-group ml-auto">
                        <input type="text" class="form-control" placeholder="請輸入關鍵字" v-model="filter" @keyup.enter="onFiltered()">
                    </div>
                </div>
                <b-table striped hover :items="items" :fields="fields" :no-local-sorting="true" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" @sort-changed="onSortChanged">
                    <template v-slot:cell(Actions)="row">
                        <b-button class="btn-warning" data-toggle="modal" data-target="#operateModal" @click="initEditModal(row.item)">
                            修改
                        </b-button>
                        <b-button class="btn-danger" data-toggle="modal" data-target="#dialogModal" @click="initDeleteModal(row.item)">
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
                            @input="onPageChanged"
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

        <div class="modal bd-example-modal-lg" id="operateModal" tabindex="-1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog mw-100 w-75">
                <div class="modal-content">
                    <div v-if="isModalReady">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold">{{ modalTitle }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" ref="operateModalClose">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form v-if="type === GLOBAL.SERVICE_STAFF">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">員工代號</label>
                                        <input type="text" class="form-control" v-model="item.Code">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">員工名稱</label>
                                        <input type="text" class="form-control" v-model="item.Name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">員工簡稱</label>
                                        <input type="text" class="form-control" v-model="item.NickName">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">身分證號</label>
                                        <input type="text" class="form-control" v-model="item.SerialNumber">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">職務</label>
                                        <select class="form-control" v-model="item.AccessLevel">
                                            <option v-for="accessLevel in accessLevels" v-bind:value="accessLevel">{{ accessLevel }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">小姐本名</label>
                                        <input type="text" class="form-control" v-model="item.RealName">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">電話</label>
                                        <input type="text" class="form-control" v-model="item.Phone">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">生日</label>
                                        <input type="date" class="form-control" v-model="item.Birthday">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">聯絡地址</label>
                                        <input type="text" class="form-control" v-model="item.ContactAddress">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">戶籍地址</label>
                                        <input type="text" class="form-control" v-model="item.ResidenceAddress">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">到職日期</label>
                                        <input type="date" class="form-control" v-model="item.ArrivedDate">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">離職日期</label>
                                        <input type="date" class="form-control" v-model="item.LeavedDate">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">備註</label>
                                        <input type="text" class="form-control" v-model="item.Note">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">下檔</label>
                                        <select class="form-control" v-model="item.IsDisable">
                                            <option>是</option>
                                            <option>否</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">經紀人</label>
                                        <input type="text" class="form-control" v-model="item.Manager">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">檔別</label>
                                        <select class="form-control" v-model="item.FileType">
                                            <option v-for="fileType in fileTypes" v-bind:value="fileType">{{ fileType }}</option>
                                        </select>
                                    </div>
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
        <div class="modal bd-example-modal-lg" id="exportModal" tabindex="-1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog mw-100 w-75">
                <div class="modal-content">
                    <div v-if="isModalReady">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold">{{ modalTitle }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" ref="exportModalClose">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form v-if="type === GLOBAL.SERVICE_STAFF">
                                <b-form-group label="請選擇要匯出的欄位">
                                    <b-form-checkbox-group v-model="selectedColumnExported">
                                        <b-form-checkbox v-for="columnExported in columnsExported" v-bind:value="columnExported.key">{{ columnExported.label }}</b-form-checkbox>
                                    </b-form-checkbox-group>
                                </b-form-group>
                            </form>
                            
                            <form v-if="type === GLOBAL.SERVICE_ROOM">
                            </form>

                            <form v-if="type === GLOBAL.SERVICE_FOOD">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary" @click="operateItem()" v-if="isExportItemApiReady">匯出</button>
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
        <div class="modal bd-example-modal-sm" id="dialogModal" tabindex="-1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div v-if="isModalReady">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold">{{ modalTitle }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" ref="dialogModalClose">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           確定要刪除 {{ item.Name }} 嗎？
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
                defaultItem: {},
                item: {},
                columnsExported: [],
                selectedColumnExported: [],

                filter: '',
                sortBy: '',
                sortDesc: '',
                totalRows: '',
                currentPage: '',
                perPage: '',

                accessLevels: [],
                fileTypes: [],

                headerTitle: '',
                modalTitle: '',
                modalActionAdd: 'add',
                modalActionEdit: 'edit',
                modalActionDelete: 'delete',
                modalActionExport: 'export',
                modalAction: '',

                getItemsUrl: '',
                addItemUrl: '',
                editItemUrl: '',
                deleteItemUrl: '',
                exportItemUrl: '',
                getItemMiscUrl: '',

                isTableReady: false,
                isModalReady: false,
                isItemApiReady: true,
                isExportItemApiReady: true
            }
        },
        methods: {
            init() {
                //跳窗載入完成
                this.isModalReady = false;
                //ITEM操作API按鈕是否可按
                this.isItemApiReady = true;

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
                this.addItemUrl = '/api/' + this.type;
                this.editItemUrl = '/api/' + this.type;
                this.deleteItemUrl = '/api/' + this.type;
                this.exportItemUrl = '/api/' + this.type + '/export';
                this.getItemMiscUrl = '/api/' + this.type + '/misc';

                this.filter = ''
                this.sortBy = 'Name';
                this.sortDesc = false;
                this.currentPage = 1;

                //初始化預設欄位、表單
                let self = this;
                axios.get(this.getItemMiscUrl).then(function (response) {
                    self.accessLevels = response.data.data.accessLevels;
                    self.fileTypes = response.data.data.fileTypes;
                    self.defaultItem = response.data.data.defaultItem;
                    
                    //初始化表格標頭
                    self.initFields();
                    //初始化匯出欄位
                    self.initSelectedColumnExported();
                    //讀取資料
                    self.getItems();
                }).catch(function (error) {
                });

            },
            initFields() {
                this.columnsExported = [];
                this.fields = [];
                if (this.type == this.GLOBAL.SERVICE_STAFF) {
                    //從1開始是因為第0個欄位是id，這裡不需要
                    for (let i = 1; i < this.defaultItem.length; ++i) {
                        let defaultItem = this.defaultItem[i];

                        let tmp = {
                            key: defaultItem.key,
                            label: defaultItem.label,
                            sortable: defaultItem.sortable
                        };

                        //for匯出
                        this.columnsExported.push(tmp);

                        if (defaultItem.key == 'Code' || defaultItem.key == 'Name' || defaultItem.key == 'RealName' || defaultItem.key == 'NickName' || defaultItem.key == 'SerialNumber') {
                            //for表格標頭
                            this.fields.push(tmp);
                        }
                    }
                    this.fields.push({
                        key: 'Actions',
                        label: '操作',
                        sortable: false
                    });
                }
                if (this.type == this.GLOBAL.SERVICE_ROOM) {
                }
                if (this.type == this.GLOBAL.SERVICE_FOOD) {
                }
            },
            initSelectedColumnExported() {
                this.selectedColumnExported = [];
                //從1開始是因為第0個欄位是id，這裡不需要
                for (let i = 1; i < this.defaultItem.length; ++i) {
                    let defaultItem = this.defaultItem[i];
                    
                    this.selectedColumnExported.push(defaultItem.key);
                }
            },
            initItem() {
                this.item = {};
                if (this.type == this.GLOBAL.SERVICE_STAFF) {
                    for (let i = 0; i < this.defaultItem.length; ++i) {
                        let defaultItem = this.defaultItem[i];

                        this.item[defaultItem.key] = defaultItem.default;
                    }
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

                    this.isModalReady = true;
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

                    //acquire selected data
                    this.item = item;
                    
                    this.isModalReady = true;
                }
            },
            initExportModal(item) {
                //reset modal status
                this.isModalReady = false;

                //setting modal action
                this.modalAction = this.modalActionExport;

                //EXPORT API按鈕是否可按
                this.isExportItemApiReady = true;

                //set modal title
                this.modalTitle = '匯出';

                if (this.type == this.GLOBAL.SERVICE_STAFF) {
                    this.modalTitle += '員工';

                    this.isModalReady = true;
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
            initDeleteModal(item) {
                //reset modal status
                this.isModalReady = false;

                //setting modal action
                this.modalAction = this.modalActionDelete;

                //ITEM操作API按鈕是否可按
                this.isItemApiReady = true;

                //reset modal data
                this.initItem();

                //set modal title
                this.modalTitle = '刪除';

                if (this.type == this.GLOBAL.SERVICE_STAFF) {
                    this.modalTitle += '員工';

                    this.isModalReady = true;

                    //acquire selected data
                    this.item = item;
                }
            },
            onFiltered() {
                console.log(this.filter);
                this.getItems();
            },
            operateItem() {
                let self = this;
                if (this.modalAction == this.modalActionAdd) {
                    this.isItemApiReady = false;

                    axios.post(this.addItemUrl, {
                        'Item': this.item
                    }).then(function (response) {
                        if (response.data.data == true) {
                            self.$refs['operateModalClose'].click();

                            //讀取資料
                            self.getItems();
                        }
                        else {
                            self.isItemApiReady = true;
                        }
                    }).catch(function (error) {
                        self.isItemApiReady = true;

                        console.log(error);
                        console.log(error.response);
                    });
                }
                if (this.modalAction == this.modalActionEdit) {
                    this.isItemApiReady = false;

                    axios.put(this.editItemUrl, {
                        'Item': this.item
                    }).then(function (response) {
                        if (response.data.data == true) {
                            self.$refs['operateModalClose'].click();

                            //讀取資料
                            self.getItems();
                        }
                        else {
                            self.isItemApiReady = true;
                        }
                    }).catch(function (error) {
                        self.isItemApiReady = true;
                    });
                }
                if (this.modalAction == this.modalActionDelete) {
                    this.isItemApiReady = false;

                    axios.delete(this.deleteItemUrl, {
                        data: {
                            Id: this.item.Id
                        }
                    }).then(function (response) {
                        if (response.data.data == true) {
                            self.$refs['dialogModalClose'].click();

                            //讀取資料
                            self.getItems();
                        }
                        else {
                            self.isItemApiReady = true;
                        }
                    }).catch(function (error) {
                        self.isItemApiReady = true;
                    });
                }
                if (this.modalAction == this.modalActionExport) {
                    this.isExportItemApiReady = false;

                    let filename = this.type + '.xlsx';
                    //下載
                    axios.request({
                        method:'GET',
                        url: this.exportItemUrl,      
                        responseType: 'arraybuffer', 
                    }).then(function (response) {
                        self.$refs['exportModalClose'].click();

                        const url = window.URL.createObjectURL(new Blob([response.data]));
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download', filename);
                        link.click();
                        window.URL.revokeObjectURL(url);
                    }).catch(function (error) {
                    });
                }
            },
            getItems() {
                //頁面載入完成
                this.isTableReady = false;

                //初始化資料
                this.items= [];
                this.initItem();
                
                this.getItemsUrl = '/api/' + this.type;

                //取得資料並渲染在頁面上
                let self = this;
                axios.get(this.getItemsUrl, {
                    params: {
                        SortBy: this.sortBy,
                        SortDesc: this.sortDesc,
                        CurrentPage: this.currentPage,
                        Filter: this.filter
                    }
                }).then(function (response) {
                    self.items = response.data.data.items;

                    self.filter = response.data.data.filter;
                    self.sortBy = response.data.data.sortBy;
                    self.sortDesc = response.data.data.sortDesc;
                    self.totalRows = response.data.data.totalRows;
                    self.currentPage = response.data.data.currentPage;
                    self.perPage = response.data.data.perPage;

                    self.isTableReady = true;
                }).catch(function (error) {
                });
            },
            onPageChanged(e) {
                this.currentPage = e;

                this.getItems();
            },
            onSortChanged(e) {
                if (e.sortBy == '') {
                    console.log(this.sortBy);
                    return;
                }

                this.sortBy = e.sortBy;
                this.sortDesc = e.sortDesc;

                this.getItems();
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
