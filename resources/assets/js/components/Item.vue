<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">{{ headerTitle }}</div>
            <div class="card-body">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" @click="redirectToAddItem()">新增</button>
                </div>
                <table class="table table-striped table-md">
                    <thead>
                        <tr>
                            <th v-show="type === 'staff'">員工Id</th>
                            <th v-show="type === 'staff'">員工編號</th>
                            <th v-show="type === 'staff'">員工名稱</th>
                            <th v-show="type === 'staff'">員工狀態</th>

                            <th v-show="type === 'room'">包廂Id</th>
                            <th v-show="type === 'room'">包廂編號</th>
                            <th v-show="type === 'room'">包廂名稱</th>
                            <th v-show="type === 'room'">包廂狀態</th>

                            <th v-show="type === 'food'">餐點Id</th>
                            <th v-show="type === 'food'">餐點編號</th>
                            <th v-show="type === 'food'">餐點名稱</th>
                            <th v-show="type === 'food'">餐點狀態</th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <router-view></router-view>
                        <tr v-show="type === 'staff'" v-for="item in items">
                            <td>{{ item.id }}</td>
                            <td>{{ item.no }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.status }}</td>
                            <td>
                                <button type="button" class="btn btn-warning">修改</button>
                                <button type="button" class="btn btn-danger">移除</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items: [],
                item: {},
                type: '',
                headerTitle: ''
            }
        },
        methods: {
            init() {
                this.type = this.$route.params.type;
                if (this.type == 'staff') {
                    this.headerTitle = '員工資料';
                } 
                else if (this.type == 'room') {
                    this.headerTitle = '包廂資料';
                }
                else if (this.type == 'food') {
                    this.headerTitle = '餐點資料';
                }
                else {
                    this.headerTitle = '錯誤';
                }

                let self = this;
                axios.get('/api/' + this.type)
                    .then(function (response) {
                        self.items = response.data.data;
                        console.log(self.items);
                    })
                    .catch(function (response) {
                        console.log(response);
                    });
            },
            redirectToAddItem() {
                if (this.type == 'staff') {
                    this.$router.push('/item/staff/add');
                } 
                else if (this.type == 'room') {
                    this.$router.push('/item/room/add');
                }
                else if (this.type == 'food') {
                    this.$router.push('/item/food/add');
                }
                else {
                    this.$router.push('');
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
