<template>
    <nav class="nav flex-column col-md-2 bg-light" style="min-height:100vh;">
        <a class="nav-link active" href="#">員工資料</a>
        <a class="nav-link" href="#">包廂資料</a>
        <a class="nav-link" href="#">餐點資料</a>
        <a class="nav-link disabled" href="#">Disabled</a>
    </nav>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
