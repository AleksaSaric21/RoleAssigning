import Home from './components/Home';
import ListTasks from './components/tasks/ListTasks';
import CreateTask from './components/tasks/CreateTask';
import EditTask from './components/tasks/EditTask';
import ViewTask from "./components/tasks/ViewTask";
import AdminPanel from "./components/AdminPanel";
import Login from "./components/Login";
import Register from "./components/Register";


export default {
    mode:'history',
    routes:[
        {
            path:'/',
            component: Home
        },
        {
            path: '/tasks',
            component: ListTasks,
            meta:{
                requiresAuth: true
            },
        },
        {
            path: '/tasks/create',
            component: CreateTask,
            meta:{
                requiresAuth: true
            },
        },
        {
            path: '/tasks/edit/:id',
            component: EditTask,
            meta:{
                requiresAuth: true
            },
        },
        {
            path: '/tasks/:id',
            component: ViewTask
        },
        {
            path: '/admin',
            component: AdminPanel,
            meta:{
                requiresAuth: true
            },
        },
        {
            path: '/login',
            component: Login
        },
        {
            path: '/register',
            component: Register
        }

    ]
}