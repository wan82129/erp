<template>
    <div>
        Item vue
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items: [],
                item: {
                    id: null,
                    name: ''
                }
            }
        },
        methods: {
            init() {
                console.log(this);
                
                let self = this;
                axios.get('/api/staffs')
                    .then(function (response) {
                        console.log(response.data);
                    })
                    .catch(function (response) {
                        console.log(response);
                    });
            },
            add() {

            },
            edit() {

            },
            delete() {

            }
        },
        mounted() {
            console.log('Component mounted.');
            this.init();
        }
    }
</script>
