<template>
    <div class="d-flex kanban-user-container">
        <!-- Menu laterale -->
        <div class="col-2 settings-lateral-menu">
            <ul class="d-flex flex-column align-items-start justify-content-center mb-0">
                <li>
                    <router-link to="/user" class="nav-link" exact-active-class="active">
                        <span>
                            <font-awesome-icon :icon="['fas', 'user-cog']" class="custom-sub-nav-icon"></font-awesome-icon>
                        </span>
                        <span class="ms-1 custom-sub-nav-text">Impostazioni utente</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/user/settings" class="nav-link" active-class="active">
                        <span>
                            <font-awesome-icon :icon="['fas', 'wrench']" class="custom-sub-nav-icon"></font-awesome-icon>
                        </span>
                        <span class="ms-1 custom-sub-nav-text">Impostazioni</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/user/theme" class="nav-link" active-class="active">
                        <span>
                            <font-awesome-icon :icon="['fas', 'brush']" class="custom-sub-nav-icon"></font-awesome-icon>
                        </span>
                        <span class="ms-1 custom-sub-nav-text">Colori</span>
                    </router-link>
                </li>
                <li>
                    <a href="#" class="nav-link" @click.prevent="logout">
                        <span>
                            <font-awesome-icon :icon="['fas', 'sign-out-alt']" class="custom-sub-nav-icon"></font-awesome-icon>
                        </span>
                        <span class="ms-1 custom-sub-nav-text">Logout</span>
                    </a>
                </li>

            </ul>
        </div>

        <!-- Contenuto dinamico -->
        <div class="col-10 rounded ms-3 p-4">
            <router-view></router-view>
        </div>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

const logout = async () => {
    try {
        await axios.post('/logout');

        localStorage.removeItem('token');

        router.push('/login');
        location.reload();
    } catch (error) {
        console.error('Errore durante il logout:', error);
    }
};
</script>