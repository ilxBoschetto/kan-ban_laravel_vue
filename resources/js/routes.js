import KanBan from './pages/KanBan.vue';
import User from './pages/User.vue';
import Home from './pages/Home.vue';
import UserHome from './components/user/UserHome.vue';
import UserSettings from './components/user/UserSettings.vue';
import Settings from './components/user/Settings.vue';
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
        component: User, // Layout principale per tutte le sottoroute
        children: [
            {
                path: '',
                name: 'user',
                component: UserSettings, // Pagina predefinita (dashboard o home)
            },
            {
                path: 'user_home',
                name: 'user_home',
                component: UserHome,
            },
            {
                path: 'settings',
                name: 'settings',
                component: Settings,
            },
        ],
    },
    {
        path: '/:catchAll(.*)',
        redirect: '/kanban',
    },
];