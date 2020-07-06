<template>
    <tr>
        <td v-show="type === 'staff'">員工001</td>
        <td v-show="type === 'room'">包廂001</td>
        <td v-show="type === 'food'">餐點001</td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <button type="button" class="btn btn-success">確認</button>
            <button type="button" class="btn btn-light">取消</button>
        </td>
    </tr>
</template>

<script>
    export default {
        data() {
            return {
                type: '',
            }
        },
        methods: {
            init() {
                this.type = this.$route.params.type;
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
