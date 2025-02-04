<template>
  <div class="kanban-card":style="{color:'black', border: '0.2rem solid ' + getStatusColor(task_status_id), height: 'auto'}">
    <div class="flex items-center gap-2 pb-2">
        <font-awesome-icon
        :icon="getIconClass(task_type_id)"
        :style="{ backgroundColor: getIconColor(task_type_id), padding: '0.4rem', borderRadius: '20%' }"
        >
        </font-awesome-icon>
        <div class="font-weight-bold">
            {{ name }}
        </div>
    </div>
        <div class="task-description">
            {{ description }}
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
});

// get taskType from parent
const taskTypes = inject('taskTypes');
const taskStatuses = inject('taskStatuses');

// functions
const getIconClass = (task_type_id) => {
    const taskType = taskTypes.value.find(type => type.id == task_type_id);
    return taskType ? ['fas', taskType.icon] : ['fas', 'question'];
};

const getIconColor = (task_type_id) => {
    const taskType = taskTypes.value.find(type => type.id == task_type_id);
    return taskType ? taskType.background_color : 'white';
}

const getStatusColor = (task_status_id) => {
    const taskStatus = taskStatuses.value.find(status => status.id == task_status_id);
    return taskStatus ? taskStatus.background_color : 'white';
}

</script>

<style scoped>

.task-description{
    color: rgb(81, 81, 81)
}
.ghost{
    opacity:0.4;
    border-color: white !important;
}

.ghost > div{
    visibility: hidden;
    transition: transform 0.1s ease, box-shadow 0.1s ease;
}

</style>