<template>
    <div class="kanban-user-container">
        <ul class="d-flex flex-column align-items-start justify-content-center mb-0">
            <li>
                <router-link to="/user/user_home" class="nav-link" active-class="active">
                    <font-awesome-icon :icon="['fas', 'home']" class="custom-nav-icon"></font-awesome-icon>
                </router-link>
            </li>
            <li>
                <router-link to="/user/user_settings" class="nav-link" active-class="active">
                    <font-awesome-icon :icon="['fas', 'user-cog']" class="custom-nav-icon"></font-awesome-icon>
                </router-link>
            </li>
            <li>
                <router-link to="/user/settings" class="nav-link" active-class="active">
                    <font-awesome-icon :icon="['fas', 'wrench']" class="custom-nav-icon"></font-awesome-icon>
                </router-link>
            </li>
        </ul>
    </div>
</template>
<script scoped>

</script>