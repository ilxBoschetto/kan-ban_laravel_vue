<template>
    <nav class="custom-navbar">
        <ul class="d-flex align-items-center justify-content-center mb-0">
            <li>
                <router-link to="/home" class="nav-link" active-class="active">
                    <font-awesome-icon :icon="['fas', 'home']" class="custom-nav-icon"></font-awesome-icon>
                </router-link>
            </li>
            <li>
                <router-link to="/kanban" class="nav-link" active-class="active">
                    <font-awesome-icon :icon="['fas', 'tasks']" class="custom-nav-icon"></font-awesome-icon>
                </router-link>
            </li>
            <li>
                <router-link to="/user" class="nav-link" active-class="active">
                    <font-awesome-icon :icon="['fas', 'user']" class="custom-nav-icon"></font-awesome-icon>
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script setup>
</script>

<style scoped>


</style>
