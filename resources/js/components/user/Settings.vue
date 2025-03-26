<template>
    <div class="my-2 p-0">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-primary"><strong>Task Types</strong></h2>
          <table class="table table-striped rounded overflow-hidden">
            <thead class="bg-primary text-white">
              <tr>
                <th>Name</th>
                <th>Icon</th>
                <th>Background Color</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="type in taskTypes" :key="type.id">
                <td>{{ type.name }}</td>
                <td>
                  <span class="d-flex align-items-center">
                    <font-awesome-icon :icon="['fas', type.icon]" class="me-2 p-2 rounded-circle shadow"
                      :style="{ backgroundColor: type.background_color, color: isLightColor(type.background_color) ? 'black' : 'white' }" />
                    {{ type.icon }}
                  </span>
                </td>
                <td>
                  <span class="badge p-2 shadow-sm rounded-pill"
                    :style="{ background: type.background_color, color: isLightColor(type.background_color) ? 'black' : 'white' }">
                    {{ type.background_color }}
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-success"><strong>Task Statuses</strong></h2>
          <table class="table table-striped rounded overflow-hidden">
            <thead class="bg-success text-white">
              <tr>
                <th>Status</th>
                <th>Background Color</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="status in taskStatuses" :key="status.id">
                <td>
                  <span class="badge p-2 shadow-sm rounded-pill"
                    :style="{ background: status.background_color, color: isLightColor(status.background_color) ? 'black' : 'white' }">
                    {{ status.name }}
                  </span>
                </td>
                <td>
                  <span class="badge p-2 shadow-sm rounded-pill"
                    :style="{ background: status.background_color, color: isLightColor(status.background_color) ? 'black' : 'white' }">
                    {{ status.background_color }}
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <h2 class="mb-3 text-danger"><strong>Task Priorities</strong></h2>
          <table class="table table-striped rounded overflow-hidden">
            <thead class="bg-danger text-white">
              <tr>
                <th>Priority</th>
                <th>Icon</th>
                <th>Background Color</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="priority in taskPriorities" :key="priority.id">
                <td>{{ priority.name }}</td>
                <td>
                  <span class="d-flex align-items-center">
                    <font-awesome-icon :icon="['fas', priority.icon]" class="me-2 p-2 rounded-circle shadow"
                      :style="{ backgroundColor: priority.background_color, color: isLightColor(priority.background_color) ? 'black' : 'white' }" />
                    {{ priority.icon }}
                  </span>
                </td>
                <td>
                  <span class="badge p-2 shadow-sm rounded-pill"
                    :style="{ background: priority.background_color, color: isLightColor(priority.background_color) ? 'black' : 'white' }">
                    {{ priority.background_color }}
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
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
  const taskTypes = ref([]);
  const taskStatuses = ref([]);
  const taskPriorities = ref([]);
  
  onMounted(() => {
    getTaskTypes();
    getTaskStatuses();
    getTaskPriorities();
  });
  
  /**
   * Functions
   */
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
  };

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
  