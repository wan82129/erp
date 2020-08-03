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
                                        <label class="col-form-label">員工代號<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="item.Code">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">員工名稱<span class="text-danger">*</span></label>
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
                                        <label class="col-form-label">職務<span class="text-danger">*</span></label>
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
                                        <label class="col-form-label">下檔<span class="text-danger">*</span></label>
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
                                        <label class="col-form-label">檔別<span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="item.FileType">
                                            <option v-for="fileType in fileTypes" v-bind:value="fileType">{{ fileType }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="font-weight-bold">薪水相關資料</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">幹部薪別</label>
                                        <input type="text" class="form-control" v-model="item.StaffSalaryType">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">小姐薪別</label>
                                        <input type="text" class="form-control" v-model="item.LadySalaryType">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Show</label>
                                        <input type="text" class="form-control" v-model="item.ShowColumn">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">卡號</label>
                                        <input type="text" class="form-control" v-model="item.CardNumber">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">每日保薪 元/日</label>
                                        <input type="text" class="form-control" v-model="item.SalaryPerDay">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">責任額 元/月</label>
                                        <input type="text" class="form-control" v-model="item.Liability">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">檯費類別</label>
                                        <input type="text" class="form-control" v-model="item.BarFeeType">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">經紀費 元/日</label>
                                        <input type="text" class="form-control" v-model="item.BrokerageFeePerDay">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">經紀費 元/節</label>
                                        <input type="text" class="form-control" v-model="item.BrokerageFeePerSection">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">清潔費 元/日</label>
                                        <input type="text" class="form-control" v-model="item.CleaningFee">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">日回節數</label>
                                        <input type="text" class="form-control" v-model="item.SectionPerDay">
                                    </div>
                                    <div class="form-group col-md-2 ">
                                        <label class="col-form-label">節抽薪:1</label>
                                        <input type="text" class="form-control" v-model="item.SectionCost1">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">節抽薪:2</label>
                                        <input type="text" class="form-control" v-model="item.SectionCost2">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">帶檯費 元/節</label>
                                        <input type="text" class="form-control" v-model="item.TakeBarFee">
                                    </div>
                                    <div class="form-group col-md-3 offset-md-1">
                                        <label class="col-form-label">更動日期</label>
                                        <input type="date" class="form-control" v-model="item.UpdatedTime" readonly>
                                    </div>
                                </div>
                            </form>
                            
                            <form v-if="type === GLOBAL.SERVICE_CUSTOMER">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">客戶代號<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="item.Code">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">姓名<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="item.Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">公司</label>
                                        <input type="text" class="form-control" v-model="item.Company">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">生日</label>
                                        <input type="date" class="form-control" v-model="item.Birthday">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">信用額度</label>
                                        <input type="text" class="form-control" v-model="item.Credit">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">開發票<span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="item.IsOpenReceipt">
                                            <option>是</option>
                                            <option>否</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">發票檯頭</label>
                                        <input type="text" class="form-control" v-model="item.ReceiptTitle">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">發票地址</label>
                                        <input type="text" class="form-control" v-model="item.ReceiptAddress">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">收款地址</label>
                                        <input type="text" class="form-control" v-model="item.GetPaidAddress">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">聯絡人</label>
                                        <input type="text" class="form-control" v-model="item.Contactor">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">統一編號</label>
                                        <input type="text" class="form-control" v-model="item.TaxNumber">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">電話號碼</label>
                                        <input type="text" class="form-control" v-model="item.Phone">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">備註</label>
                                        <input type="text" class="form-control" v-model="item.Note">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">放單日</label>
                                        <input type="date" class="form-control" v-model="item.ReleaseOrderDate">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">收款日</label>
                                        <input type="date" class="form-control" v-model="item.GetPaidDate">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">清帳方式</label>
                                        <input type="text" class="form-control" v-model="item.ClearLog">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">前更動日</label>
                                        <input type="date" class="form-control" v-model="item.PreUpdatedTime" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">最後更動日</label>
                                        <input type="date" class="form-control" v-model="item.UpdatedTime" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">最後消費日期</label>
                                        <input type="date" class="form-control" v-model="item.LatestConsumpDate">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">業績幹部<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="item.StaffCode" @input="onInputGetStaffName">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">業績幹部<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="customerStaffName" readonly>
                                    </div>
                                    <div class="form-group col-md-4 offset-md-2">
                                        <label class="col-form-label">客戶類別</label>
                                        <input type="text" class="form-control" v-model="item.CustomerType">
                                    </div>
                                </div>
                            </form>

                            <form v-if="type === GLOBAL.SERVICE_ROOM">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">包廂代號<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="item.Code">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">包廂名稱<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="item.Name">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">級數<span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="item.Level">
                                            <option v-for="roomLevel in roomLevels" v-bind:value="roomLevel">{{ roomLevel }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">容納人數</label>
                                        <input type="text" class="form-control" v-model="item.LimitCount">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">開桌菜<span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="item.HaveDefaultOpeningFood">
                                            <option>是</option>
                                            <option>否</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">早班價</label>
                                        <input type="text" class="form-control" v-model="item.MorningPrice">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">晚班價</label>
                                        <input type="text" class="form-control" v-model="item.NightPrice">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">逾時價</label>
                                        <input type="text" class="form-control" v-model="item.TimeoutPrice">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">備註</label>
                                        <input type="text" class="form-control" v-model="item.Note">
                                    </div>
                                </div>
                            </form>

                            <form v-if="type === GLOBAL.SERVICE_FOOD">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">貨品代號<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="item.Code">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">貨品名稱<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="item.Name">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">單位<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="item.Count">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">物品類別<span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="item.Type">
                                            <option v-for="foodType in foodTypes" v-bind:value="foodType">{{ foodType }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">開桌菜<span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="item.IsDefaultOpeningFood">
                                            <option>是</option>
                                            <option>否</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">可做招待<span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="item.IsFreeService">
                                            <option>是</option>
                                            <option>否</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">酒別</label>
                                        <input type="text" class="form-control" v-model="item.WineType">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="col-form-label">開桌數(一般)</label>
                                        <input type="text" class="form-control" v-model="item.DefaultOpeningFoodCount1">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="col-form-label">開桌數(一級)</label>
                                        <input type="text" class="form-control" v-model="item.DefaultOpeningFoodCount2">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="col-form-label">開桌數(二級)</label>
                                        <input type="text" class="form-control" v-model="item.DefaultOpeningFoodCount3">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="col-form-label">開桌數(三級)</label>
                                        <input type="text" class="form-control" v-model="item.DefaultOpeningFoodCount4">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="col-form-label">開桌數(四級)</label>
                                        <input type="text" class="form-control" v-model="item.DefaultOpeningFoodCount5">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="col-form-label">開桌數(五級)</label>
                                        <input type="text" class="form-control" v-model="item.DefaultOpeningFoodCount6">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="col-form-label">開桌數(六級)</label>
                                        <input type="text" class="form-control" v-model="item.DefaultOpeningFoodCount7">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">自助售價</label>
                                        <input type="text" class="form-control" v-model="item.SelfHelpPrice">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">一般售價</label>
                                        <input type="text" class="form-control" v-model="item.Price">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">會員售價</label>
                                        <input type="text" class="form-control" v-model="item.PremiumPrice">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">備註</label>
                                        <input type="text" class="form-control" v-model="item.Note">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">計存量<span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="item.IsCount">
                                            <option>是</option>
                                            <option>否</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">目前存量</label>
                                        <input type="text" class="form-control" v-model="item.CurrentCount">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">計業績<span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="item.IsScore">
                                            <option>是</option>
                                            <option>否</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">抵低消<span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="item.IsLowestThershold">
                                            <option>是</option>
                                            <option>否</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">計營業額<span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="item.IsTurnover">
                                            <option>是</option>
                                            <option>否</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">最近進貨日期</label>
                                        <input type="date" class="form-control" v-model="item.LatestPurchaseDate">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">進貨單價</label>
                                        <input type="text" class="form-control" v-model="item.PurchasePrice">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">進貨廠商</label>
                                        <input type="text" class="form-control" v-model="item.PurchaseCompany">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <div class="mr-auto" v-if="modalAction === modalActionEdit">
                                <button type="button" class="btn btn btn-link" @click="previousItem()">上一筆(PageUp)</button>
                                <button type="button" class="btn btn btn-link" @click="nextItem()">下一筆(PageDown)</button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-primary" @click="operateItem()" v-if="isItemApiReady">確認</button>
                                <b-button variant="primary" disabled v-else>
                                    <b-spinner small></b-spinner>
                                </b-button>
                            </div>
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
                            <b-form-group label="請選擇要匯出的欄位">
                                <b-form-checkbox-group v-model="selectedColumnExported">
                                    <b-form-checkbox v-for="columnExported in columnsExported" v-bind:value="columnExported.key">{{ columnExported.label }}</b-form-checkbox>
                                </b-form-checkbox-group>
                            </b-form-group>
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

                fields: [], //要顯示的標頭&排序
                items: [], //資料集合
                defaultItem: {}, //預設的所有欄位、預設值、標籤名稱與排序
                item: {}, //新增或刪除使用的單筆空資料
                columnsExported: [], //所有可匯出的欄位
                selectedColumnExported: [], //選擇要匯出的欄位

                filter: '',
                sortBy: '',
                sortDesc: '',
                totalRows: '',
                currentPage: '',
                perPage: '',

                accessLevels: [], //staff 職務
                fileTypes: [], //staff 檔別
                customerStaffName: '', //客戶的業績幹部
                roomLevels: [], //包廂等級
                foodTypes: [], //餐點類別

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
                getCustomerStaffNameUrl: '',

                isTableReady: false,
                isModalReady: false,
                isItemApiReady: true,
                isExportItemApiReady: true
            }
        },
        methods: {
            init() {
                //表格載入完成
                this.isTableReady = false;
                //跳窗載入完成
                this.isModalReady = false;
                //ITEM操作API按鈕是否可按
                this.isItemApiReady = true;

                //目前頁面種類，覺得title和取得資料的api
                this.type = this.$route.params.type;
                if (this.type == this.GLOBAL.SERVICE_STAFF) {
                    this.headerTitle = '員工資料';
                } 
                if (this.type == this.GLOBAL.SERVICE_CUSTOMER) {
                    this.headerTitle = '客戶資料';
                } 
                if (this.type == this.GLOBAL.SERVICE_ROOM) {
                    this.headerTitle = '包廂資料';
                }
                if (this.type == this.GLOBAL.SERVICE_FOOD) {
                    this.headerTitle = '貨品資料';
                }
                if (this.type == this.GLOBAL.SERVICE_BAR) {
                    this.headerTitle = '檯費拆帳';
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
                    if (self.type == self.GLOBAL.SERVICE_STAFF) {
                        self.accessLevels = response.data.data.accessLevels;
                        self.fileTypes = response.data.data.fileTypes;
                    } 
                    if (self.type == self.GLOBAL.SERVICE_CUSTOMER) {
                    }
                    if (self.type == self.GLOBAL.SERVICE_ROOM) {
                        self.roomLevels = response.data.data.roomLevels;
                    }
                    if (self.type == self.GLOBAL.SERVICE_FOOD) {
                        self.foodTypes = response.data.data.foodTypes;
                    }
                    if (self.type == self.GLOBAL.SERVICE_BAR) {
                    }

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
                }
                if (this.type == this.GLOBAL.SERVICE_CUSTOMER) {
                }
                if (this.type == this.GLOBAL.SERVICE_ROOM) {
                }
                if (this.type == this.GLOBAL.SERVICE_FOOD) {
                }

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

                    if (defaultItem.field == true) {
                        //for表格標頭
                        this.fields.push(tmp);
                    }
                }
                this.fields.push({
                    key: 'Actions',
                    label: '操作',
                    sortable: false
                });

                console.log(this.fields);
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
                for (let i = 0; i < this.defaultItem.length; ++i) {
                    let defaultItem = this.defaultItem[i];

                    this.item[defaultItem.key] = defaultItem.default;
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
                }
                
                if (this.type == this.GLOBAL.SERVICE_CUSTOMER) {
                    this.modalTitle += '客戶';

                    //初始化客戶的業績幹部
                    this.customerStaffName = '';
                }

                if (this.type == this.GLOBAL.SERVICE_ROOM) {
                    this.modalTitle += '包廂';
                }
                
                if (this.type == this.GLOBAL.SERVICE_FOOD) {
                    this.modalTitle += '貨品';
                }

                this.isModalReady = true;
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

                //acquire selected data
                this.item = item;

                if (this.type == this.GLOBAL.SERVICE_STAFF) {
                    this.modalTitle += '員工';
                }

                if (this.type == this.GLOBAL.SERVICE_CUSTOMER) {
                    this.modalTitle += '客戶';

                    //初始化業績幹部
                    this.customerStaffName = '';

                    //根據客戶的staff code取得客戶的staff名稱
                    this.getCustomerStaffNameByCode()
                }

                if (this.type == this.GLOBAL.SERVICE_ROOM) {
                    this.modalTitle += '包廂';
                }

                if (this.type == this.GLOBAL.SERVICE_FOOD) {
                    this.modalTitle += '貨品';
                }

                this.isModalReady = true;
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
                }
                
                if (this.type == this.GLOBAL.SERVICE_CUSTOMER) {
                    this.modalTitle += '客戶';
                }

                if (this.type == this.GLOBAL.SERVICE_ROOM) {
                    this.modalTitle += '包廂';
                }
                
                if (this.type == this.GLOBAL.SERVICE_FOOD) {
                    this.modalTitle += '貨品';
                }
                    
                this.isModalReady = true;
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
                }

                if (this.type == this.GLOBAL.SERVICE_CUSTOMER) {
                    this.modalTitle += '客戶';
                }

                if (this.type == this.GLOBAL.SERVICE_ROOM) {
                    this.modalTitle += '包廂';
                }
                
                if (this.type == this.GLOBAL.SERVICE_FOOD) {
                    this.modalTitle += '貨品';
                }

                this.isModalReady = true;

                //acquire selected data
                this.item = item;
            },
            onFiltered() {
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
                        params: {
                            Columns: this.selectedColumnExported
                        }
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
            nextItem() {
                for (let i = 0; i <= this.items.length; ++i) {
                    if (this.item.Id == this.items[i].Id) {
                        if (i < this.items.length - 1) {
                            this.item = this.items[i + 1];
                        }
                        break;
                    }
                }
            },
            previousItem() {
                for (let i = 0; i <= this.items.length; ++i) {
                    if (this.item.Id == this.items[i].Id) {
                        if (i >= 1) {
                            this.item = this.items[i - 1];
                        }
                        break;
                    }
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
            getCustomerStaffNameByCode() {
                let code = this.item['StaffCode'];

                if (code == '') {
                    this.customerStaffName = '查無此員工';

                    return;
                }

                this.getCustomerStaffNameUrl = '/api/' + this.GLOBAL.SERVICE_STAFF + '/code/' + code;

                let self = this;
                axios.get(this.getCustomerStaffNameUrl).then(function (response) {
                    self.customerStaffName = response.data.data;
                }).catch(function (error) {
                });
            },
            onPageChanged(e) {
                this.currentPage = e;

                this.getItems();
            },
            onSortChanged(e) {
                if (e.sortBy == '') {
                    return;
                }

                this.sortBy = e.sortBy;
                this.sortDesc = e.sortDesc;

                this.getItems();
            },
            onInputGetStaffName() {
                this.getCustomerStaffNameByCode();
            }
        },
        watch: {
            '$route.params.type': function(newVal, oldVal){
                this.init();
            }
        },
        mounted() {
            this.init();

            let self = this;
            window.addEventListener('keyup', function(event) {
                if (document.activeElement.matches('div#operateModal') && self.modalAction == self.modalActionEdit) {
                    if (event.keyCode == 33) {
                        self.previousItem();
                    }
                    if (event.keyCode == 34) { 
                        self.nextItem();
                    }
                }
            });
        }
    }
</script>
