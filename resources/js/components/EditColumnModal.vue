<template>
  <div 
    id="editColumnModal"
    class="modal fade"
    tabindex="-1"
    aria-hidden="true"
    ref="modalElement"
    @click.self="closeModal()"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <span v-if="column && column.id !== -1">Edit Column</span>
            <span v-else>New Column</span>
          </h5>
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
                @input="validateName"
                :style="{ border: inputBorder }"
              />
              <span v-if="errorMessage" class="text-danger">{{ errorMessage }}</span>
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
          <button type="submit" class="btn btn-primary" :disabled="!column.name.trim()" @click="save">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits, ref, watchEffect, nextTick, onMounted } from 'vue';
import { Modal } from 'bootstrap';

const props = defineProps({
  column: Object,
});

const emit = defineEmits(['close', 'save']);

const column = ref({ ...props.column });
const modalElement = ref(null);
const errorMessage = ref("");
const inputBorder = ref("1px solid #ced4da"); // Default Bootstrap border
let modalInstance = null;

onMounted(() => {
  modalInstance = new Modal(modalElement.value, { keyboard: false });
});

watchEffect(async () => {
  if (column.value.id !== undefined) {
    await nextTick();
    modalInstance.show(); // Open modal with fade effect
  }
});

function validateName() {
  const isValid = column.value.name.trim() !== "";

  errorMessage.value = isValid ? "" : "Column name is required.";

  // Cambia dinamicamente il bordo dell'input
  inputBorder.value = isValid ? "1px solid #ced4da" : "1px solid red";
}

function closeModal() {
  modalInstance.hide(); // Close modal with animation
  emit('close');
}

function save() {
  validateName();
  if (!column.value.name.trim()) return; // Block saving if name is empty
  emit('save', column.value);
  closeModal();
}
</script>
