import Vue from 'vue'
import Router from 'vue-router'
import End from '@/components/End'
import endHello from '@/components/end/Hello'
import endTeacher from '@/components/end/Teacher'
import endStudent from '@/components/end/Student'
import endLogin from '@/components/end/Login'
import Front from '@/components/Front'
import Hello from '@/components/front/hello'
import Teacher from '@/components/front/teacher'
import Student from '@/components/front/student'
Vue.use(Router)
var menu = [
    {
        path: '/end',
        component: End,
        children: [
            {path: '/',component: endHello},
            {path: '/end/teacher',component: endTeacher},
            {path: '/end/student',component: endStudent},
        ]
    }, 
    {
        path: '/end/login/',
        component: endLogin
    }, 
    {
        path: '/',
        component: Front,
        children: [
            {path: '/',component: Hello},
            {path: '/teacher',component: Teacher},
            {path: '/student',component: Student}
        ]
    }
];
export default new Router({
    mode: 'hash',
    routes: menu
});