<template>
    <div class="container-fluid">
        <div class="card m-2" v-if="isTableReady">
            <div class="card-header font-weight-bold">{{ headerTitle }}</div>
            <div class="card-body">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" @click="initAddModal()">
                        新增
                    </button>
                </div>
                <table class="table table-striped table-md">
                    <thead>
                        <tr>
                            <th v-if="type === 'staff'">代號</th>
                            <th v-if="type === 'staff'">名稱</th>
                            <th v-if="type === 'staff'">簡稱</th>
                            <th v-if="type === 'staff'">身分證</th>
                            <th v-if="type === 'staff'">職務</th>
                            <th v-if="type === 'staff'">電話</th>
                            <th v-if="type === 'staff'">生日</th>
                            <th v-if="type === 'staff'">在職</th>
                            
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody v-if="type === 'staff'">
                        <tr v-for="item in items">
                            <td>{{ item.Code }}</td>
                            <td>{{ item.Name }}</td>
                            <td>{{ item.NickName }}</td>
                            <td>{{ item.SerialNumber }}</td>
                            <td>{{ item.AccessLevelText }}</td>
                            <td>{{ item.Phone }}</td>
                            <td>{{ item.Birthday }}</td>
                            <td>{{ item.IsActive }}</td>
                            <td>
                                <div class="form-group">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg" @click="initEditModal(item.Id)">修改</button>
                                    <button type="button" class="btn btn-danger">移除</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" v-if="isModalReady">
                            <form v-if="type === 'staff'">
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
                                    <input type="text" class="form-control" v-model="item.Birthday">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">在職</label>
                                    <select class="form-control" v-model="item.IsActive">
                                        <option>是</option>
                                        <option>否</option>
                                    </select>
                                </div>
                            </form>
                            
                            <form v-if="type === 'room'">
                            </form>

                            <form v-if="type === 'food'">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary">確認</button>
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

                items: [],
                item: {},

                staffAccessLevels: [],
                staffAccessLevel: {
                    Id: '',
                    Text: ''
                },

                headerTitle: '',
                modalTitle: '',

                getItemsUrl: '',
                getStaffAccessLevelUrl: '',

                isTableReady: false,
                isModalReady: false,
            }
        },
        methods: {
            init() {
                //頁面載入完成
                this.isTableReady = false;
                //跳窗載入完成
                this.isModalReady = false;

                //取得StaffAccessLevel的API
                this.getStaffAccessLevelUrl = '/api/staffAccessLevel';

                //目前頁面種類，覺得title和取得資料的api
                this.type = this.$route.params.type;
                if (this.type == 'staff') {
                    this.headerTitle = '員工資料';
                    this.getItemsUrl = '/api/staff';

                } 
                if (this.type == 'room') {
                    this.headerTitle = '包廂資料';
                    this.getItemsUrl = '/api/room';
                }
                if (this.type == 'food') {
                    this.headerTitle = '餐點資料';
                    this.getItemsUrl = '/api/food';
                }

                //初始化資料
                this.initItem();

                //取得資料並渲染在頁面上
                let self = this;
                axios.get(this.getItemsUrl).then(function (response) {
                    self.items = response.data.data;

                    self.isTableReady = true;
                }).catch(function (response) {
                    console.log(response);
                });
            },
            initItem() {
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

                //reset modal data
                this.initItem();

                //set modal title
                this.modalTitle = '新增';

                if (this.type == 'staff') {
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
            },
            initEditModal(id) {
                //reset modal status
                this.isModalReady = false;

                //reset modal data
                this.initItem();


                //set modal title
                this.modalTitle = '編輯';

                if (this.type == 'staff') {
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
                    for (var i = 0; i < this.items.length; ++i) {
                        if (id == this.items[i].Id) {
                            this.item = this.items[i];
                        }
                    }
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
