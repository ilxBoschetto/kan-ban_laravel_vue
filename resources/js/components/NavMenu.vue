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

.nav-link.active .custom-nav-icon {
    transform: 2rem;
    color: var(--custom-accent);
}

.custom-navbar {
    background: var(--custom-secondary);
    padding: 0.2rem;
    border-radius: 1rem;
    max-width: 20rem;
    margin: 0.5rem auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

ul {
    list-style: none;
    padding: 0;
    display: flex;
    gap: 1.5rem;
}

li {
    display: flex;
    align-items: center;
}

.nav-link {
    color: var(--custom-primary);
    font-size: 1.2rem;
    transition: transform 0.2s, color 0.2s;
}

.nav-link:hover {
    color: var(--custom-accent);
    transform: scale(1.1);
}
.custom-nav-icon{
    font-size:1.8rem;
}
</style>
