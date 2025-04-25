import KanBan from './pages/KanBan.vue';
import User from './pages/User.vue';
import Home from './pages/Home.vue';
import UserSettings from './components/user/UserSettings.vue';
import Settings from './components/user/Settings.vue';
import Theme from './components/user/Theme.vue'
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
                path: 'settings',
                name: 'settings',
                component: Settings,
            },
            {
                path: 'theme',
                name: 'theme',
                component: Theme,
            },
        ],
    },
    {
        path: '/:catchAll(.*)',
        redirect: '/kanban',
    },
];