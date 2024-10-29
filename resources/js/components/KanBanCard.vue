<template>
  <div class="rounded bg-white p-2 my-3" :style="{color:'black', border: '0.2rem solid ' + getStatusColor(task_status_id),}">
    <div class="flex items-center gap-2 pb-2">
        <font-awesome-icon
        :icon="getIconClass(task_type_id)"
        :style="{ backgroundColor: getIconColor(task_type_id), padding: '0.4rem', borderRadius: '20%' }"
        >
        </font-awesome-icon>
        <div class="fw-bold">
            {{ id }}
        </div>
    </div>
        <div class="">
            {{ name }}
        </div>
    </div>
</template>

<script setup>
import { defineProps, ref, onMounted, inject } from 'vue';
const props = defineProps({
    id: Number,
    name: String,
    task_type_id: Number,
    task_status_id: Number,
});

// get taskType from parent
const taskTypes = inject('taskTypes');
const taskStatuses = inject('taskStatuses');

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
.drag > div{
    transform: rotate(5deg);
}

.ghost{
    opacity:0.4;
    
}


.ghost > div{
    visibility: hidden;
    transform: scale(1.05);
    transition: transform 0.1s ease, box-shadow 0.1s ease;
}

</style>