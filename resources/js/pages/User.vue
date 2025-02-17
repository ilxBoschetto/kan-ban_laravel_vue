<template>
    <div class="d-flex kanban-user-container">
        <!-- Menu laterale -->
        <div class="col-2 border-end p-3 bg-light rounded">
            <ul class="d-flex flex-column align-items-start justify-content-center mb-0">
                <li>
                    <router-link to="/user" class="nav-link" exact-class="active">
                        <span>
                            <font-awesome-icon :icon="['fas', 'user-cog']" class="custom-sub-nav-icon"></font-awesome-icon>
                        </span>
                        <span class="ms-1">Impostazioni utente</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/user/settings" class="nav-link" active-class="active">
                        <span>
                            <font-awesome-icon :icon="['fas', 'wrench']" class="custom-sub-nav-icon"></font-awesome-icon>
                        </span>
                        <span class="ms-1">Impostazioni</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/user/user_home" class="nav-link" active-class="active">
                        <span>
                            <font-awesome-icon :icon="['fas', 'poop']" class="custom-sub-nav-icon"></font-awesome-icon>
                        </span>
                        <span class="ms-1">Stefanomerda</span>
                    </router-link>
                </li>
            </ul>
        </div>

        <!-- Contenuto dinamico -->
        <div class="col-10 bg-light rounded ms-3 p-4">
            <router-view></router-view>
        </div>
    </div>
</template>
<style scoped>
.nav-link.active{
    transform: 2rem;
    font-weight: 600;
    color: var(--custom-accent);
}
</style>