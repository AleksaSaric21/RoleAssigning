<template>
    <div class="container login-container">

        <form @submit.prevent="authenticate">
            <div class="form-group">
                <input type="text" v-model="form.name"
                       class="form-control" placeholder="Your name *" value="" />
            </div>
            <div class="form-group">
                <input type="email" v-model="form.email"
                       class="form-control" placeholder="Your Email *" value="" />
            </div>
            <div class="form-group">
                <input type="password" v-model="form.password"
                       class="form-control" placeholder="Your Password *" value="" />
            </div>
            <div class="form-group">
                <input type="submit" class="btnSubmit" value="Login" />
            </div>
        </form>

    </div>
</template>

<script>


    export default {
        data(){
            return {
                form: {
                    email: '',
                    password: '',
                    name: ''
                },
                error: null
            };
        },
        methods:{
            authenticate(){
                var $data = {
                    name: this.form.name,
                    email: this.form.email,
                    password: this.form.password
                };

                axios.post('/api/register',$data)
                    .then((res) =>{
                        this.$store.commit('login_success',res.data);
                        this.$router.push(
                            {path:'/'}
                        );
                    })
                    .catch((error)=>{
                        this.$store.commit('login_failed',error);
                        alert(error);
                    });

            },


        }
    }
</script>


<style scoped>

</style>