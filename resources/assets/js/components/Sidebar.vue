<template>
    <ul class="nav flex-column">
        <li class="nav-item">
            <router-link :to="redirectToStaffUrl" class="nav-link">員工資料(S)</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="redirectToRoomUrl" class="nav-link">包廂資料(R)</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="redirectToFoodUrl" class="nav-link">餐點資料(F)</router-link>
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
            let self = this;
            window.addEventListener('keyup', function(event) {
                if (document.activeElement.matches('body')) {
                    if (event.keyCode == 83) {
                        self.$router.push(self.redirectToStaffUrl);
                    }
                    if (event.keyCode == 82) { 
                        self.$router.push(self.redirectToRoomUrl);
                    }
                    if (event.keyCode == 70) { 
                        self.$router.push(self.redirectToFoodUrl);
                    }
                }
            });
        }
    }
</script>
