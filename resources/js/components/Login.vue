<template>
    <div class="container login-container">

        <form @submit.prevent="authenticate">
            <div class="form-group">
                <input type="text" v-model="form.email"
                       class="form-control" placeholder="Your Email *" value="" />
            </div>
            <div class="form-group">
                <input type="password" v-model="form.password"
                       class="form-control" placeholder="Your Password *" value="" />
            </div>
            <div class="form-group">
                <input type="submit" class="btnSubmit" value="Login" />
            </div>
            <div class="form-group">
                <a href="#" class="ForgetPwd">Forget Password?</a>
            </div>
        </form>

    </div>
</template>

<script>


    export default {
        name: "Login",
        data(){
            return {
                form: {
                    email: '',
                    password: ''
                },
                error: null
            };
        },
        methods:{
            authenticate(){
                    let data = {
                        email: this.form.email,
                        password: this.form.password
                    };

                    axios.post('/api/login',data)
                    .then((res) =>{
                        console.log(res.data.success);
                        this.$store.commit('login_success',res);
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