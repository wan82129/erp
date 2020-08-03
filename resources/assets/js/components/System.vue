<template>
    <div class="container-fluid col-md-6">
        <div class="card m-2" v-if="isPageReady">
            <div class="card-header font-weight-bold">
                <div class="d-flex">
                    <div class="font-weight-bold">
                        系統參數
                    </div>
                    <div class="ml-auto">
                        <button type="button" class="btn btn-primary" @click="editSystemParameters()" v-if="isItemApiReady">
                            儲存
                        </button>
                        <b-button variant="primary" disabled v-else>
                            <b-spinner small></b-spinner>
                        </b-button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">公司名稱</label>
                    <input type="text" class="form-control" v-model="item.Company">
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">統一編號</label>
                    <input type="text" class="form-control" v-model="item.TaxNumber">
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">營業時間</label>
                    <input type="text" class="form-control" v-model="item.BusinessTime">
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">歇業時間</label>
                    <input type="text" class="form-control" v-model="item.ClosingTime">
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">最多幾節</label>
                    <input type="text" class="form-control" v-model="item.Sections">
                    <div class="input-group-append">
                        <span class="input-group-text">節</span>
                    </div>
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">最長完帳天數</label>
                    <input type="text" class="form-control" v-model="item.FinishPaidDeadline">
                    <div class="input-group-append">
                        <span class="input-group-text">天</span>
                    </div>
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">幾天內入現拆帳</label>
                    <input type="text" class="form-control" v-model="item.GetPaidClearLog">
                    <div class="input-group-append">
                        <span class="input-group-text">天</span>
                    </div>
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">幹部可招待額業績百分比</label>
                    <input type="text" class="form-control" v-model="item.StaffServicePercentage">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">超過消帳期限日息</label>
                    <input type="text" class="form-control" v-model="item.DeadlineExpireDayInterest">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">內定幹部拆帳類別</label>
                    <input type="text" class="form-control" v-model="item.StaffClearLogType">
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">內定檯費拆帳類別</label>
                    <input type="text" class="form-control" v-model="item.BarPaidType">
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">計算服務費</label>
                    <select class="form-control" v-model="item.IsCountServiceFee">
                        <option>是</option>
                        <option>否</option>
                    </select>
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">服務費成數</label>
                    <input type="text" class="form-control" v-model="item.ServiceFeePercentage">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">檯費計算服務費</label>
                    <select class="form-control" v-model="item.IsCountBarPaidServiceFee">
                        <option>是</option>
                        <option>否</option>
                    </select>
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">小姐代號第一碼</label>
                    <input type="text" class="form-control" v-model="item.LadyCodeFirstChar">
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">小姐算進場最後時間</label>
                    <input type="text" class="form-control" v-model="item.LadyComeLastTime">
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">座檯方式座</label>
                    <input type="text" class="form-control" v-model="item.BarSeatRound">
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">低消每人</label>
                    <input type="text" class="form-control" v-model="item.LowestThershold">
                    <div class="input-group-append">
                        <span class="input-group-text">元</span>
                    </div>
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">低消每人(寄酒者)</label>
                    <input type="text" class="form-control" v-model="item.LowestThersholdWithWine">
                    <div class="input-group-append">
                        <span class="input-group-text">元</span>
                    </div>
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">最長票期</label>
                    <input type="text" class="form-control" v-model="item.LongestTicketDay">
                    <div class="input-group-append">
                        <span class="input-group-text">天</span>
                    </div>
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">幹部通行碼</label>
                    <input type="text" class="form-control" v-model="item.StaffPassCode">
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">房號第一碼</label>
                    <input type="text" class="form-control" v-model="item.RoomCodeFirstChar">
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">員工遲到時間</label>
                    <input type="text" class="form-control" v-model="item.StaffLateTime">
                </div>
                <div class="input-group mb-3 row">
                    <label class="col-md-6 col-form-label">員工早退時間</label>
                    <input type="text" class="form-control" v-model="item.StaffAwayTime">
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-center m-3" v-else>
            <div class="spinner-border" style="width: 10rem; height: 10rem;">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                defaultItem: {}, //預設的所有欄位、預設值
                item: {}, 

                getItemUrl: '',
                editItemUrl: '',

                isPageReady: false,
                isItemApiReady: true
            }
        },
        methods: {
            init() {
                this.getItemUrl = '/api/system/parameters';
                this.editItemUrl = '/api/system/parameters';

                this.getSystemParameters();
            },
            getSystemParameters() {
                this.isPageReady = false;

                let self = this;
                axios.get(this.getItemUrl).then(function (response) {
                    self.item = response.data.data.item;

                    self.isPageReady = true;
                }).catch(function (error) {
                    self.isPageReady = true;
                });
            },
            editSystemParameters() {
                this.isItemApiReady = false;

                let self = this;
                axios.put(this.editItemUrl, {
                    'Item': this.item
                }).then(function (response) {
                    self.getSystemParameters();

                    self.isItemApiReady = true;
                }).catch(function (error) {
                    self.isItemApiReady = true;
                });
            }
        },
        mounted() {
            this.init();
        }
    }
</script>
