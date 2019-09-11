<template>

    <div class="card col-md-4 m-4">
    <form @submit.prevent="create" >

        <div class="form-group">
            <label for="formGroupExampleInput">Task Caption</label>
            <input type="text" name="caption" class="form-control" v-model="form.caption"
                   id="formGroupExampleInput">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Task Description</label>
            <textarea class="form-control" v-model="form.description"
                      name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>

</template>

<script>
    import {hasRole} from "../../helpers";

    export default {
        name: "CreateTask",
        data() {
            return {
                form:{
                    caption: '',
                    description: ''
                }
            }
        },
        methods:{
            create(){

                let isModerator = this.hasRoles(this.$store.state.currentUser.roles,'Moderator');
                console.log(this.$store.state.currentUser.user.id);

                var data = {
                    caption: this.form.caption,
                    description: this.form.description,
                    user_id: this.$store.state.currentUser.user.id,
                    isPublished: isModerator
                };
                axios.post('/api/tasks/', data).
                    then((res)=>{
                    this.$router.push({path:'/tasks',query:{alert:'Task created'}});
                }).catch((err)=>{
                        console.log(err);
                });
            },
            hasRoles(roles,role){
                return hasRole(roles,role);
            }
        }

    }

</script>

<style scoped>

</style>