import TodoComponent from './components/TodoComponent.vue';
import ExampleComponent from './components/ExampleComponent.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';

export const routes = [
    {
        path: '/todo',
        component: TodoComponent
    },
    {
        path: '/example-component',
        component: ExampleComponent
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/login',
        component: Login
    }
];