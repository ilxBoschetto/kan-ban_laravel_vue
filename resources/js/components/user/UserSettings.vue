<template>
<div>
    <strong>Impostazioni utente</strong>
    <div class="row">
        <div class="col-sm-6 pt-3">
            <form @submit.prevent="save">
                <div class="mb-3">
                    <label for="name" class="form-label">Profile Picture:</label>
                    <input
                        type="file"
                        class="form-control-file"
                        id="pfp"
                    />
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Username:</label>
                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        placeholder="mario.rossi@example.com"
                    />
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Old Password:</label>
                    <input
                        type="password"
                        class="form-control"
                        id="old_password"
                    />
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">New Password:</label>
                    <input
                        type="password"
                        class="form-control"
                        id="new_password"
                    />
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <div class="col-sm-6 d-flex justify-content-center">
        <img src="/public/default-user-image.png" style="max-height:20rem" alt="User Image">
    </div>
    </div>
</div>
</template>
<script scoped>
import { ref } from 'vue';

const imagePath = ref({
    path: "/public/default-user-image.png"
});
</script>