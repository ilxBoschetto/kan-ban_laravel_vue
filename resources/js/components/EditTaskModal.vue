<template>
  <div id="editTaskModal" class="modal fade" tabindex="-1" aria-hidden="true" ref="modalElement"
    @click.self="closeTaskModal()">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <span v-if="task && task.id !== -1">Edit Task</span>
            <span v-else>New Task</span>
          </h5>
          <button type="button" class="btn-close" @click="closeTaskModal"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="saveTask">
            <div class="mb-3">
              <label for="name" class="form-label">Task Name:</label>
              <input type="text" class="form-control" id="name" v-model="task.name" @input="validateName"
                :style="{ border: inputBorder }" />
              <span v-if="errorMessage" class="text-danger">{{ errorMessage }}</span>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description:</label>
              <input type="text" class="form-control" id="description" v-model="task.description" />
            </div>
            <div class="mb-3">
              <label for="dropdown" class="form-label">Task type:</label>
              <div class="dropdown">
                <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button"
                  @click="toggleTypeDropdown" @blur="closeTypeDropdown">
                  <font-awesome-icon :icon="getIconClass(selectedTaskType, props.taskTypes)" class="me-2"
                    :style="getIconStyle(selectedTaskType, props.taskTypes)" />
                  {{ getTaskInfoName(selectedTaskType, props.taskTypes) }}
                </button>

                <ul class="dropdown-menu" :class="{ show: isTypeDropdownOpen }">
                  <li v-for="taskType in props.taskTypes" :key="taskType.id">
                    <a class="dropdown-item d-flex align-items-center" href="#"
                      @mousedown.prevent="selectTaskType(taskType.id)">
                      <font-awesome-icon :icon="getIconClass(taskType.id, props.taskTypes)" class="me-2"
                        :style="getIconStyle(taskType.id, props.taskTypes)" />
                      {{ taskType.name }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="mb-3">
              <label for="dropdown" class="form-label">Task status:</label>
              <div class="dropdown">
                <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button"
                  @click="toggleStatusDropdown" @blur="closeStatusDropdown">
                  <div class="me-2 p-2" :style="getIconStyle(selectedTaskStatus, props.taskStatuses)" />
                  {{ getTaskInfoName(selectedTaskStatus, props.taskStatuses) }}
                </button>

                <ul class="dropdown-menu" :class="{ show: isStatusDropdownOpen }">
                  <li v-for="taskStatus in props.taskStatuses" :key="taskStatus.id">
                    <a class="dropdown-item d-flex align-items-center" href="#"
                      @mousedown.prevent="selectTaskStatus(taskStatus.id)">
                      <div class="me-2 p-2" :style="getIconStyle(taskStatus.id, props.taskStatuses)" />
                      {{ taskStatus.name }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="mb-3">
              <label for="dropdown" class="form-label">Task Priority:</label>
              <div class="dropdown">
                <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button"
                  @click="togglePriorityDropdown" @blur="closePriorityDropdown">
                  <font-awesome-icon :icon="getIconClass(selectedTaskPriority, taskPriorities)" class="me-2"
                    :style="getIconStyle(selectedTaskPriority, props.taskPriorities)" />
                  {{ getTaskInfoName(selectedTaskPriority, props.taskPriorities) }}
                </button>

                <ul class="dropdown-menu" :class="{ show: isPriorityDropdownOpen }">
                  <li v-for="taskPriority in props.taskPriorities" :key="taskPriority.id">
                    <a class="dropdown-item d-flex align-items-center" href="#"
                      @mousedown.prevent="selectTaskPriority(taskPriority.id)">
                      <font-awesome-icon :icon="getIconClass(taskPriority.id, props.taskPriorities)" class="me-2"
                        :style="getIconStyle(taskPriority.id, props.taskPriorities)" />
                      {{ taskPriority.name }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="closeTaskModal">Cancel</button>
          <button type="submit" class="btn btn-primary" :disabled="!task.name.trim()" @click="saveTask">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
/**
 * Import
 */
import { defineProps, defineEmits, ref, watchEffect, nextTick, onMounted } from 'vue';
import { Modal } from 'bootstrap';

/**
 * Props
 */
const props = defineProps({
  task: Object,
  taskTypes: Array,
  taskStatuses: Array,
  taskPriorities: Array,
});

/**
 * Emit
 */
const emit = defineEmits(['closeTaskModal', 'saveTask']);

/**
 * Variabili
 */
const task = ref({ ...props.task });
const modalElement = ref(null);
const errorMessage = ref("");
const inputBorder = ref("1px solid #ced4da"); // Default Bootstrap border
const selectedTaskType = ref(props.taskTypes.length ? props.taskTypes[0].id : null);
const selectedTaskStatus = ref(props.taskStatuses.length ? props.taskStatuses[0].id : null);
const selectedTaskPriority = ref(props.taskPriorities.length ? props.taskPriorities[0].id : null);
const isTypeDropdownOpen = ref(false);
const isStatusDropdownOpen = ref(false);
const isPriorityDropdownOpen = ref(false);
let taskModalInstance = null;

onMounted(() => {
  taskModalInstance = new Modal(modalElement.value, { keyboard: false });
});

watchEffect(async () => {
  if (task.value.id !== undefined) {
    await nextTick();
    taskModalInstance.show(); // Open modal with fade effect
  }
});

/**
 * Functions
 */
function validateName() {
  const isValid = task.value.name.trim() !== "";
  errorMessage.value = isValid ? "" : "Task name is required.";
  // Cambia dinamicamente il bordo dell'input
  inputBorder.value = isValid ? "1px solid #ced4da" : "1px solid red";
}

const closeTypeDropdown = () => {
  setTimeout(() => isTypeDropdownOpen.value = false, 0); // Delay to allow click selection
};

const closeStatusDropdown = () => {
  setTimeout(() => isStatusDropdownOpen.value = false, 0); // Delay to allow click selection
};

const closePriorityDropdown = () => {
  setTimeout(() => isPriorityDropdownOpen.value = false, 0); // Delay to allow click selection
};

const toggleTypeDropdown = () => {
  isTypeDropdownOpen.value = !isTypeDropdownOpen.value;
};

const toggleStatusDropdown = () => {
  isStatusDropdownOpen.value = !isStatusDropdownOpen.value;
};

const togglePriorityDropdown = () => {
  isPriorityDropdownOpen.value = !isPriorityDropdownOpen.value;
};

const selectTaskType = (task_type_id) => {
  selectedTaskType.value = task_type_id;
  isTypeDropdownOpen.value = false;
};

const selectTaskStatus = (task_status_id) => {
  selectedTaskStatus.value = task_status_id;
  isStatusDropdownOpen.value = false;
};

const selectTaskPriority = (task_priority_id) => {
  selectedTaskPriority.value = task_priority_id;
  isPriorityDropdownOpen.value = false;
};

const getTaskInfoName = (task_type_id, taskInfos) => {
  const taskInfo = taskInfos.find(type => type.id == task_type_id);
  return taskInfo ? taskInfo.name : 'Unknown';
};

const getIconClass = (task_type_id, taskInfo) => {
  const taskType = taskInfo.find(type => type.id == task_type_id);
  return taskType ? ['fas', taskType.icon] : ['fas', 'question'];
};

const getIconStyle = (task_type_id, taskInfos) => {
  const taskInfo = taskInfos.find(type => type.id == task_type_id);
  return {
    padding: '0.4rem',
    borderRadius: '20%',
    color: 'black', // Per contrasto
    border: '0.1rem solid gray'
  };
};

function saveTask() {
  validateName();
  if (!task.value.name.trim()) return; // Block saving if name is empty
  emit('saveTask', {
    task: task.value,
    column_id: task.value.column_id,
    task_type_id: selectedTaskType.value,
    task_status_id: selectedTaskStatus.value,
    task_priority_id: selectedTaskPriority.value,
  });
  closeTaskModal();
}

function closeTaskModal() {
  taskModalInstance.hide(); // Close modal with animation
  emit('closeTaskModal');
}

</script>