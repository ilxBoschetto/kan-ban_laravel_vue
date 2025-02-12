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
        name: 'user',
        component: User,
    },
    {
        path: '/user/user_home',
        name: 'user_home',
        component: UserHome,
    },
    {
        path: '/user/user_settings',
        name: 'user_settings',
        component: UserSettings,
    },
    {
        path: '/user/settings',
        name: 'settings',
        component: Settings,
    },
];