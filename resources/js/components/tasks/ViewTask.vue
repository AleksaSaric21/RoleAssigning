<template>
    <div class="card col-md-5 m-4">
        <div class="card-header card-title d-flex justify-content-between">
            <div>{{ task.caption }}</div>
            <div>{{ task.updated_at }}</div>
        </div>
        <div class="card-body">
            <p class="card-text">{{ task.description }}</p>
            <router-link to="/tasks">back</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ViewTask.vue",
        data(){
            return {
                task:'',
            }
        },
        methods:{
            getTask(id){
                axios.get('/api/tasks/'+id).then((response)=>{

                    this.task = response.data.data;
                }).catch((error)=>{
                    console.log(error);
                })
            }
        },
        created:
                function(){

                this.getTask(this.$route.params.id);
            }


    }
</script>

<style scoped>

</style>