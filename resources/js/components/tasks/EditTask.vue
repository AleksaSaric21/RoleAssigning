<template>
    <form class="col-md-3">

            <div class="form-group ">
            <label for="formGroupExampleInput">Task Caption</label>
            <input type="text" name="caption" v-model="task.caption"
                   class="form-control" id="formGroupExampleInput">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Task Description</label>
            <textarea class="form-control" name="description"
                      id="exampleFormControlTextarea1" rows="3" v-model="task.description"></textarea>
        </div>
        <button type="submit" @click.prevent="editTask" class="btn btn-primary">Submit</button>
    </form>

</template>

<script>
    export default {
        name: "EditTask",
        data(){
            return {

                form: {
                    caption:'',
                    description:''
                },
                task: {
                    id: '',
                    caption:'',
                    description:'',
                    user:''
                }
            }
        },
        methods:{
            getTask(id){
                axios.get('/api/tasks/'+id).then((response)=>{
                    this.task.caption = response.data.data.caption;
                    this.task.description = response.data.data.description;
                    this.task.id = response.data.data.id;
                    this.task.user = response.data.data.user;
                })
            },
            editTask(){
                console.log(this.task.id);
                axios.patch('/api/tasks/'+this.task.id,
                    {
                        caption: this.task.caption,
                        description: this.task.description,
                        user_id: this.task.user.user_id,

                    }).
                then((response)=>{
                   this.$router.push({path:'/tasks',query:{alert:'Task updated'}});
                })
            }
        },
        created: function () {
            this.getTask(this.$route.params.id);
        }
    }
</script>

<style scoped>

</style>