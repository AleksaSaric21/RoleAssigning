
import {getUser} from './helpers';

let user = getUser();

export default {
    state:{
        currentUser: user,
        isLoggedIn: false,
        authError: '',
        loginMessage:''
    },
    getters: {

    },
    mutations:{
        login_success(state,payload){

             let user = payload.data.success;
             this.state.currentUser = user;
             console.log(this.currentUser);
            localStorage.setItem('user',JSON.stringify(user));
            this.state.isLoggedIn = true;
            this.state.loginMessage = 'You are logged in!';

        },
        login_failed(err){
            this.state.isLoggedIn = false;
            this.state.loginMessage = 'Login failed';
        }
    },
    actions: {



},
}