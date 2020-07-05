<template>
    <nav class="nav flex-column col-md-2 bg-light" style="min-height:100vh;">
        <router-link :to="{ name: 'staff' }" class="nav-link">員工資料</router-link>
        <router-link :to="{ name: 'room' }" class="nav-link">包廂資料</router-link>
        <router-link :to="{ name: 'food' }" class="nav-link">餐點資料</router-link>
    </nav>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
