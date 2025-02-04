<template>
    <div
      id="editColumnModal"
      class="modal fade"
      tabindex="-1"
      aria-hidden="true"
      v-show="isModalOpen"
      @click.self="closeModal"
      :class="{'show': isModalOpen}"
      style="display: block;"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Column</h5>
            <button type="button" class="btn-close" @click="closeModal"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="save">
              <div class="mb-3">
                <label for="name" class="form-label">Column Name:</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  v-model="column.name"
                />
              </div>
              <div class="mb-3">
                <label for="background_color" class="form-label">Background Color:</label>
                <input
                  type="color"
                  class="form-control form-control-color"
                  id="background_color"
                  v-model="column.background"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">Cancel</button>
            <button type="submit" class="btn btn-primary" @click="save">Save</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps, defineEmits, ref, watchEffect } from 'vue';
  
  const props = defineProps({
    column: Object,
  });
  
  const emit = defineEmits(['close', 'save']);
  
  const column = ref({ ...props.column });
  const isModalOpen = ref(false);
  
  watchEffect(() => {
    isModalOpen.value = !!column.value.id; // Quando la colonna cambia, apri il modale
  });
  
  function closeModal() {
    emit('close');
  }
  
  function save() {
    emit('save', column.value);
    closeModal();
  }
  </script>
  