<template>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{message}}</strong>
    </div>
</template>

<script>
    export default {
        name: "alert.vue",
        props: ['message'],
        data(){
            return{

            }
        }
    }
</script>

<style scoped>

</style>