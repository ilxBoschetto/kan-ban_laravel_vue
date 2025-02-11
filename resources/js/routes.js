import KanBan from './pages/KanBan.vue';
import User from './pages/User.vue';
import Home from './pages/Home.vue';
export default [
    {
        path: '/kanban',
        name: 'kanban',
        component: KanBan,
    },
    {
        path: '/home',
        name: 'home',
        component: Home,
    },
    {
        path: '/user',
        name: 'user',
        component: User,
    },
];