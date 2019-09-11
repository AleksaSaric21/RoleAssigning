<template>
    <div>
        <div  class="card col-md-4 m-4"  >
            <Alert v-if="alert" v-bind:message="alert"></Alert>
            <div v-for="(task,index) in tasks"
                 v-bind:class="{'notPublished': task.isPublished == 0,
                 'notVisible': task.user.id!=user.user.id && !checkIfHasRole(user.roles,'Moderator')
                 && !task.isPublished}">
                <div class="card-header card-title d-flex justify-content-between">
                    {{ task.caption }}

                        <div>
                            {{ task.created_at }}
                        </div>


                </div>
                <div class="card-body">
                    <p class="card-text">{{ task.description }}</p>
                    <div class="d-flex justify-content-between align-items-center">

                    <router-link class="btn btn-secondary" v-bind:to="`tasks/${task.id}`">
                        See post</router-link>
                    <template v-if="user!=null && task.user.id==user.user.id">
                    <router-link class="btn btn-secondary"
                                 v-bind:to="`tasks/edit/${task.id}`">Edit task</router-link>
                    <form action="" method="post">
                        <input type="submit" @click.prevent="deleteTask(index,task)"
                               class="btn-secondary" value="Delete post">
                    </form>
                    </template>
                    </div>

                </div>
                <template v-if="user!=null && checkIfHasRole(user.roles,'Moderator') && !task.isPublished">
                    <form @click.prevent="publish(task)">
                        <input type="submit"
                           class="btn-secondary" value="Publish">
                    </form>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    import Alert from '../Alert';
    import {getUser} from '../../helpers';
    import {hasRole} from "../../helpers";

    let currUser = getUser();
    export default {
        name: "TaskList",

        data(){
            return {
                tasks: [],
                alert:'',
                user: currUser,
            }
        },
        methods:{

            getTasks(){

                let api = this.user ? "?api_token="+this.user.api_token : '';
                axios.get('/api/tasks'+api).
                then((response) => {

                    this.tasks = response.data.data;
                }).catch((error)=>{

                });
            },
            deleteTask(index,task){

                axios.delete('/api/tasks/'+task.id).
                then((response) => {
                    this.tasks.splice(index,1);
                    this.alert = "You successfuly deleted task";
                }).catch((error)=>{
                    this.alert = "There was an error in your request";
                });
            },
            checkIfHasRole(roles,role){
                console.log(roles[0]);
              return hasRole(roles,role);
            },
            publish(task){
                task.isPublished = 1;
                axios.patch('/api/tasks/'+task.id,task)
                      .then((res)=>{
                          console.log(res);
                    }).catch((err)=>{
                        console.log(err);
                });
            }
        },
        created() {
            if (this.$route.query.alert){
                this.alert = this.$route.query.alert;
            }

            this.user = getUser();
            console.log(this.user,"hehe");
            this.getTasks();

        },
        computed:{
            modifed(){
                return this.tasks;
            }
        },
        components:{
            Alert,
        }

    }
</script>

<style lang="scss" scoped>
    .notPublished{
        opacity: 0.6;
    }
    .notVisible{
        display:none;
    }
</style>