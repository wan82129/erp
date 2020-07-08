<template>
    <ul class="nav flex-column">
        <li class="nav-item">
            <router-link :to="redirectToStaffUrl" class="nav-link">員工資料</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="redirectToRoomUrl" class="nav-link">包廂資料</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="redirectToFoodUrl" class="nav-link">餐點資料</router-link>
        </li>
    </ul>
</template>

<script>
    export default {
        data() {
            return {
                redirectToStaffUrl: '/item/' + this.GLOBAL.SERVICE_STAFF,
                redirectToRoomUrl: '/item/' + this.GLOBAL.SERVICE_ROOM,
                redirectToFoodUrl: '/item/' + this.GLOBAL.SERVICE_FOOD,
            }
        },
        mounted() {
        }
    }
</script>
