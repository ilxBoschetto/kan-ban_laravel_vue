<template>
    <div class="kanban-dashboard-container">
    <div id="spinner-wheel" class="loader-container">
        <font-awesome-icon :icon="['fas', 'spinner']" spin class="loader-icon"></font-awesome-icon>
    </div>
      <h1 class="mb-4">Kanban Dashboard</h1>
  
      <div class="row mb-4">
        <!-- Task Totali -->
        <div class="col-md-4">
        <div class="card text-white bg-dark mb-3 position-relative">
            <div class="card-body">
            <h5 class="card-title">Task Totali</h5>
            <p class="card-text display-4">{{ tasks.length }}</p>
            </div>
        </div>
        </div>
      </div>
      <div class="row mb-4">
        <div v-for="taskStatus in taskStatuses" :key="taskStatus.id" class="col-md-4">
            <div :class="{
                'text-dark': isLightColor(taskStatus.background_color),
                'text-white': !isLightColor(taskStatus.background_color)
                }" :style="{ background: taskStatus.background_color, borderRadius: '0.2rem', border: '0.1rem solid silver' }">
                <div class="position-absolute top-0 end-4 p-2"
                    :class="{
                        'text-dark': isLightColor(taskStatus.background_color),
                        'text-white': !isLightColor(taskStatus.background_color)
                    }"
                    style="font-size: 1.2rem">
                    ({{ ((tasks.filter(task => task.task_status_id === taskStatus.id).length / tasks.length) * 100).toFixed(2) }}%)
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ taskStatus.name }}</h5>
                    <p class="card-text display-4">{{ tasks.filter(task => task.task_status_id === taskStatus.id).length }}</p>
                </div>
            </div>
        </div>
      </div>
      <div class="row mb-4">
        <div v-for="taskType in taskTypes" :key="taskType.id" class="col-md-4">
            <div :class="{
            'text-dark': isLightColor(taskType.background_color),
            'text-white': !isLightColor(taskType.background_color)
            }" :style="{ background: taskType.background_color, borderRadius: '0.2rem', border: '0.1rem solid silver' }">
            <div class="position-absolute top-0 end-4 p-2"
                :class="{
                    'text-dark': isLightColor(taskType.background_color),
                    'text-white': !isLightColor(taskType.background_color)
                }"
                style="font-size: 1.2rem">
                ({{ ((tasks.filter(task => task.task_type_id === taskType.id).length / tasks.length) * 100).toFixed(2) }}%)
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    
                    {{ taskType.name }}</h5>
                <p class="card-text display-4">
                    <font-awesome-icon
                        :icon="getIconClass(taskType.id)"
                        
                        :style="{ color: getIconColor(taskType.id), padding: '0.4rem', borderRadius: '10%', backgroundColor: isLightColor(taskType.background_color) ? '#323333' : 'white' }"
                    ></font-awesome-icon>
                    {{ tasks.filter(task => task.task_type_id === taskType.id).length }}</p>
            </div>
            </div>
        </div>
        </div>
        <div class="row mb-4">
        <div v-for="taskPriority in taskPriorities" :key="taskPriority.id" class="col-md-4">
            <div :class="{
            'text-dark': isLightColor(taskPriority.background_color),
            'text-white': !isLightColor(taskPriority.background_color)
            }" :style="{ background: taskPriority.background_color, borderRadius: '0.2rem', border: '0.1rem solid silver' }">
            <div class="position-absolute top-0 end-4 p-2"
                :class="{
                    'text-dark': isLightColor(taskPriority.background_color),
                    'text-white': !isLightColor(taskPriority.background_color)
                }"
                style="font-size: 1.2rem">
                ({{ ((tasks.filter(task => task.task_priority_id === taskPriority.id).length / tasks.length) * 100).toFixed(2) }}%)
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    
                    {{ taskPriority.name }}</h5>
                <p class="card-text display-4">
                    <font-awesome-icon
                        :icon="getIconClassPriority(taskPriority.id)"
                        
                        :style="{ color: getIconColorPriority(taskPriority.id), padding: '0.4rem', borderRadius: '10%', backgroundColor: isLightColor(taskPriority.background_color) ? '#323333' : 'white' }"
                    ></font-awesome-icon>
                    {{ tasks.filter(task => task.task_priority_id === taskPriority.id).length }}</p>
            </div>
            </div>
        </div>
        </div>
    </div>
  </template>
  
<script setup>
/**
 * Import
 */
import { ref, onMounted } from 'vue';
import axios from 'axios';
/**
 * Variables
 */
const boardId = 1;
const columns = ref([]);
const tasks = ref([]);
const taskTypes = ref([]);
const taskStatuses = ref([]);
const taskPriorities = ref([]);

/**
 * Functions
 */
onMounted(() => {
  initKanBan();
  getTaskTypes();
  getTaskStatuses();
  getTaskPriorities();
})

const initKanBan = () => {
  loadingCallback(true);
  axios.get('/api/kanban', {
    params: {
      boardId: boardId
    }
  })
    .then((response) => {
      columns.value = response.data.columns;
      getAllTasks();
    });
};

const getAllTasks = () => {
    axios.get('/api/alltasks', {
    params: {
      boardId: boardId
    }
  })
    .then((response) => {
        tasks.value = response.data;
        loadingCallback(false);
    });
}

const loadingCallback = (isLoading) => {
    if (isLoading) {
        $('#spinner-wheel').removeClass('d-none');
        $('#spinner-wheel').addClass('d-flex');
    } else {
        $('#spinner-wheel').addClass('d-none');
        $('#spinner-wheel').removeClass('d-flex');
    }
}

const getTaskTypes = () => {
  axios.get('/api/tasktypes')
    .then((response) => {
      taskTypes.value = response.data;
    });
};

const getTaskStatuses = () => {
  axios.get('/api/taskstatuses')
    .then((response) => {
      taskStatuses.value = response.data;
    });
};

const getTaskPriorities = () => {
  axios.get('/api/taskpriorities')
    .then((response) => {
      taskPriorities.value = response.data;
    });
}

const getIconClass = (task_type_id) => {
    const taskType = taskTypes.value.find(type => type.id == task_type_id);
    return taskType ? ['fas', taskType.icon] : ['fas', 'question'];
};

const getIconColor = (task_type_id) => {
    const taskType = taskTypes.value.find(type => type.id == task_type_id);
    return taskType ? taskType.background_color : 'white';
}

const getIconClassPriority = (task_type_id) => {
    const taskPriority = taskPriorities.value.find(type => type.id == task_type_id);
    return taskPriority ? ['fas', taskPriority.icon] : ['fas', 'question'];
};

const getIconColorPriority = (task_type_id) => {
    const taskPriority = taskPriorities.value.find(type => type.id == task_type_id);
    return taskPriority ? taskPriority.background_color : 'white';
}

function isLightColor(hex) {
  if (!hex) return true; // Se non c'è colore, assume sfondo chiaro

  hex = hex.replace('#', ''); // Rimuove il simbolo #

  // Converte il colore in RGB
  const r = parseInt(hex.substring(0, 2), 16);
  const g = parseInt(hex.substring(2, 4), 16);
  const b = parseInt(hex.substring(4, 6), 16);

  // Calcola la luminosità
  const brightness = (r * 299 + g * 587 + b * 114) / 1000;

  return brightness > 180; // Se è luminoso, ritorna true
}

</script>
  