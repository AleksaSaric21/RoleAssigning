<template>
    <table cellpadding="25px" style="margin: 0 auto; padding: 20px;">
        <caption>Assign role by checking the box</caption>
        <thead>
        <tr>
            <th>Num</th>
            <th>Email</th>
            <th>Name</th>
            <th>Moderator</th>
            <th>Author</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(user,index) in users">
            <td>{{index+1}}</td>
            <td>{{user.email}}</td>
            <td>{{user.name}}</td>
            <td>


                    <input type="checkbox" @change="toggleModeratorRole(user.id)"
                           name="toggleModerator"
                           id="toggleModerator" v-bind:checked="checked(user.roles,'Moderator')">

            </td>
            <td>

                    <input type="checkbox" @change="toggleAuthorRole(user.id)" name="toggleAuthor"
                           id="toggleAuthor" v-bind:checked="checked(user.roles,'Author')">

            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>

        import {hasRole} from "../helpers";

        export default {
        name: "AdminPanel",
        data() {
            return {
                users: [],
                moduleChecked: true,
                check: 'checked'
            }
        },
        methods: {
            getUsers() {
                axios.get('/api/users').then(res => {
                    console.log(res.data.success);
                    this.users = res.data.success;
                }).catch(err => {
                    console.log(err);
                })

            },
            getCheck(roleName, user) {
                user.roles.forEach(role => {
                    console.log(role.name == roleName);
                    return roleName == role.name;
                });
            },
            checked(roles,role){
               let roleNames = roles.map((role)=>{
                   return role.name;
               });
               return hasRole(roleNames, role) ? 'checked' : '';
            },
            toggleModeratorRole(id){

                console.log(id);
                axios.post('/api/users/moderator/'+id,{

                }).then((res)=>{
                    console.log(res);

                })
            },
            toggleAuthorRole(id){

                axios.post('/api/users/author/'+id,{

                }).then((res)=>{

                    console.log(res);

                }).catch((err)=>{
                    alert(err);
                })
            },
        },

        created: function () {
            this.getUsers();
        },

    }
</script>

<style scoped>

</style>