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
                        @change="handleFileChange"
                    />
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Username:</label>
                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        placeholder="Username"
                        v-model="user.username"
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
                        v-model="password"
                    />
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" @click="saveUser">Save</button>
                </div>
            </form>
        </div>
        <div class="col-sm-6 d-flex justify-content-center">
        <img :src="imageFile" style="max-height:20rem" alt="User Image">
    </div>
    </div>
</div>
</template>
<script setup>
/**
 * Imports
 */
import { ref, onMounted } from 'vue';
import axios from 'axios';

/**
 * Variables
 */
const user = ref({
    username: '',
    email: '',
});
const password = ref(null);
const imageFile = ref('/public/default-user-image.png');

onMounted(() => {
    getUser();
});

/**
 * Functions
 */
const getUser = () => {
    axios.get('/api/get_logged_user')
    .then((response) => {
        user.value = response.data;
        imageFile.value = response.data.image;
    });
};

const saveUser = () => {
    let formData = new FormData();

    formData.append('name', user.value.name);
    formData.append('email', user.value.email);
    formData.append('username', user.value.username);

    if (password.value) {
        formData.append('password', password.value);
    }

    if (imageFile.value) {
        formData.append('image', imageFile.value);
    }

    axios.post('/api/update_logged_user', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then((response) => {
        console.log(response);
    })
    .catch(error => {
        console.error('Error updating user:', error);
    });
};

const handleFileChange = (event) => {
    imageFile.value = event.target.files[0];
};
</script>