<template>
  <div
    class="kanban-card"
    :style="{ height: 'auto' }"
  >
    <div class="flex items-center gap-2 pb-2">
      <font-awesome-icon
        class="card-icon"
        :icon="getIconClass(task_type_id)"
        :style="{ backgroundColor: getIconColor(task_type_id) }"
      >
      </font-awesome-icon>
      <div class="font-weight-bold" :style="{ textDecorationColor: getStatusColor(task_status_id)}">
        {{ name }}
      </div>
    </div>
    <div class="d-flex justify-content-between">
      <div class="task-description">
          {{ description }}
      </div>
      <!-- Sezione Priorità -->
      <div class="priority-section d-flex align-items-center justify-content-end">
          <font-awesome-icon
          :icon="getPriorityIcon(task_priority_id)"
          class="mr-1 priority-box"
          :style="{ borderColor: getPriorityColor(task_priority_id) }"
          >
          </font-awesome-icon>
      </div>
    </div>
    
    
  </div>
</template>

<script setup>
// Import
import { ref, onMounted, inject } from 'vue';

// Define Variables

// Define Props
const props = defineProps({
  id: Number,
  name: String,
  description: String,
  task_type_id: Number,
  task_status_id: Number,
  task_priority_id: Number
});

// get taskType from parent
const taskTypes = inject('taskTypes');
const taskStatuses = inject('taskStatuses');
const taskPriorities = inject('taskPriorities');

// functions
const getIconClass = (task_type_id) => {
  const taskType = taskTypes.value.find(type => type.id == task_type_id);
  return taskType ? ['fas', taskType.icon] : ['fas', 'question'];
};

const getIconColor = (task_type_id) => {
  const taskType = taskTypes.value.find(type => type.id == task_type_id);
  return taskType ? taskType.background_color : 'black';
}

const getStatusColor = (task_status_id) => {
  const taskStatus = taskStatuses.value.find(status => status.id == task_status_id);
  return taskStatus ? taskStatus.background_color : 'black';
}

const getPriorityIcon = (task_priority_id) => {
  const taskPriority = taskPriorities.value.find(priority => priority.id == task_priority_id);
  return taskPriority ? ['fas', taskPriority.icon] : ['fas', 'question'];
}

const getPriorityColor = (task_priority_id) => {
  const taskPriority = taskPriorities.value.find(priority => priority.id == task_priority_id);
  return taskPriority ? taskPriority.background_color : 'black';
}

</script>