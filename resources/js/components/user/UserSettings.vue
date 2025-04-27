<template>
    <div class="settings-user-form">
        <h3><strong>Impostazioni utente</strong></h3>
        <div class="row">
            <div class="col-sm-6 pt-3">
                <form @submit.prevent="save">
                    <div class="mb-3">
                        <label for="name" class="form-label" v-if="!isLoading">Username:</label>
                        <div v-else class="skeleton-label"></div>
                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            placeholder="Username"
                            v-model="user.username"
                            v-if="!isLoading"
                        />
                        <div v-else class="skeleton-field"></div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label" v-if="!isLoading">Old Password:</label>
                        <div v-else class="skeleton-label"></div>
                        <input
                            type="password"
                            class="form-control"
                            id="old_password"
                            v-if="!isLoading"
                        />
                        <div v-else class="skeleton-field"></div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label" v-if="!isLoading">New Password:</label>
                        <div v-else class="skeleton-label"></div>
                        <input
                            type="password"
                            class="form-control"
                            id="new_password"
                            v-model="password"
                            v-if="!isLoading"
                        />
                        <div v-else class="skeleton-field"></div>
                    </div>
                    <div>
                        <button type="submit" class="custom-success-button" @click="saveUser">Save</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-6 d-flex justify-content-center">
                <div v-if="!isLoading">
                    <label for="fileInput" class="image-label">
                    <img :src="imageFile" style="max-height: 20rem; border-radius: 0.5rem;" alt="">
                    </label>
                    <input
                        type="file"
                        id="fileInput"
                        class="d-none"
                        @change="handleFileChange"
                    />
                </div>
                <div class="ghost-loader" v-else></div>
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
    const imageToUpload = ref(null);
    const isLoading = ref(true);
    
    onMounted(() => {
        getUser();
    });
    
    /**
     * Functions
     */
    const getUser = () => {
        isLoading.value = true;
        axios.get('/api/get_logged_user')
        .then((response) => {
            user.value = response.data;
            imageFile.value = response.data.image || '/public/default-user-image.png';
            isLoading.value = false;
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
    
        if (imageToUpload.value) {
            formData.append('image', imageToUpload.value);
        }
    
        axios.post('/api/update_logged_user', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then((response) => {
            location.reload();
        })
        .catch(error => {
            console.error('Error updating user:', error);
        });
    };
    
    const handleFileChange = (event) => {
        const file = event.target.files[0];
        if (file) {
            // Create preview
            imageFile.value = URL.createObjectURL(file);
    
            // Image to send to the backend
            imageToUpload.value = file;
        }
    };
    
    </script>
    <style scoped>
    .image-label:hover{
        cursor: pointer;
    }
    .image-label{
        border: 0.15rem solid var(--custom-primary);
        border-radius: 0.5rem;
    }
    
    .skeleton-field {
      width: 100%;
      height: 2.5rem;
      border-radius: 0.5rem;
      background-color: var(--custom-skeleton-base);
      animation: pulse 1.5s infinite ease-in-out;
    }
    
    .skeleton-label {
      width: 120px;
      height: 1.25rem;
      margin: 0 0 0.8rem 0;
      border-radius: 0.25rem;
      background-color: var(--custom-skeleton-base);
      animation: pulse 1.5s infinite ease-in-out;
    }
    
    .ghost-loader {
      width: 100%;
      height: 20rem;
      border-radius: 0.5rem;
      background-color: var(--custom-skeleton-base);
      animation: pulse 1.5s infinite ease-in-out;
    }
    
    @keyframes pulse {
      0% {
        opacity: 0.3;
      }
      50% {
        opacity: 1;
      }
      100% {
        opacity: 0.3;
      }
    }
    </style>