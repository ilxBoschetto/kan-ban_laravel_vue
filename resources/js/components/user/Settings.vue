<template>
  <div class="container my-4">
    <!-- TASK TYPES -->
    <div class="row">
      <div class="col-md-12">
          <div v-if="isLoadingTypes" class="skeleton-label"></div>
        <h2 v-else class="mb-3 text-primary"><strong>Task Types</strong></h2>

        <div v-if="isLoadingTypes" class="skeleton-loader" :style="{ height: tableHeights.taskTypes + 'px' }"></div>
        <table v-else ref="taskTypesTable" class="table table-bordered shadow-sm">
          <thead class="table-dark">
            <tr>
              <th>Name</th>
              <th>Icon</th>
              <th>Background Color</th>
            </tr>
          </thead>
          <tbody>
            <template v-if="isLoadingTypes">
              <tr v-for="n in 3" :key="n">
                <td><span class="placeholder col-6"></span></td>
                <td><span class="placeholder col-4"></span></td>
                <td><span class="placeholder col-6"></span></td>
              </tr>
            </template>
            <template v-else>
              <tr v-for="type in taskTypes" :key="type.id">
                <td>{{ type.name }}</td>
                <td>
                  <span class="d-flex align-items-center">
                    <font-awesome-icon :icon="['fas', type.icon]" class="me-2 p-2 rounded-circle shadow-sm"
                      :style="{ backgroundColor: type.background_color}" />
                    {{ type.icon }}
                  </span>
                </td>
                <td>
                  <span class="badge p-2"
                    :style="{ background: type.background_color}">
                    {{ type.background_color }}
                  </span>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>

    <!-- TASK STATUSES -->
    <div class="row mt-5">
      <div class="col-md-12">
          <div v-if="isLoadingStatuses" class="skeleton-label"></div>
        <h2 v-else class="mb-3 text-success"><strong>Task Statuses</strong></h2>
        <div v-if="isLoadingStatuses" class="skeleton-loader" :style="{ height: tableHeights.taskStatuses + 'px' }"></div>
        <table v-else ref="taskStatusesTable" class="table table-bordered shadow-sm">
          <thead class="table-dark">
            <tr>
              <th>Status</th>
              <th>Color</th>
            </tr>
          </thead>
          <tbody>
            <template v-if="isLoadingStatuses">
              <tr v-for="n in 3" :key="n">
                <td><span class="placeholder col-6"></span></td>
                <td><span class="placeholder col-6"></span></td>
              </tr>
            </template>
            <template v-else>
              <tr v-for="status in taskStatuses" :key="status.id">
                <td>
                  <span class="badge p-2"
                    :style="{ background: status.background_color }">
                    {{ status.name }}
                  </span>
                </td>
                <td>
                  <span class="badge p-2"
                    :style="{ background: status.background_color }">
                    {{ status.background_color }}
                  </span>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>

    <!-- TASK PRIORITIES -->
    <div class="row mt-5">
      <div class="col-md-12">
          <div v-if="isLoadingPriorities" class="skeleton-label"></div>
        <h2 v-else class="mb-3 text-danger"><strong>Task Priorities</strong></h2>
        
        <div v-if="isLoadingPriorities" class="skeleton-loader" :style="{ height: tableHeights.taskPriorities + 'px' }"></div>
        <table v-else ref="taskPrioritiesTable" class="table table-bordered shadow-sm">
          <thead class="table-dark">
            <tr>
              <th>Priority</th>
              <th>Icon</th>
              <th>Background Color</th>
            </tr>
          </thead>
          <tbody>
            <template v-if="isLoadingPriorities">
              <tr v-for="n in 3" :key="n">
                <td><span class="placeholder col-6"></span></td>
                <td><span class="placeholder col-4"></span></td>
                <td><span class="placeholder col-6"></span></td>
              </tr>
            </template>
            <template v-else>
              <tr v-for="priority in taskPriorities" :key="priority.id">
                <td>{{ priority.name }}</td>
                <td>
                  <span class="d-flex align-items-center">
                    <font-awesome-icon :icon="['fas', priority.icon]" class="me-2 p-2 rounded-circle shadow-sm"
                      :style="{ backgroundColor: priority.background_color }" />
                    {{ priority.icon }}
                  </span>
                </td>
                <td>
                  <span class="badge p-2"
                    :style="{ background: priority.background_color }">
                    {{ priority.background_color }}
                  </span>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

/**
 * Variables
 */
  const taskTypes = ref([]);
  const taskStatuses = ref([]);
  const taskPriorities = ref([]);

  const isLoadingTypes = ref(true);
  const isLoadingStatuses = ref(true);
  const isLoadingPriorities = ref(true);
  const taskTypesTable = ref(null);
  const taskStatusesTable = ref(null);
  const taskPrioritiesTable = ref(null);
  const maxTableHeight = 400; // Imposta un limite massimo per le altezze delle tabelle

  const tableHeights = ref({
      taskTypes: Math.min(localStorage.getItem('taskTypesHeight') || 200, maxTableHeight),
      taskStatuses: Math.min(localStorage.getItem('taskStatusesHeight') || 200, maxTableHeight),
      taskPriorities: Math.min(localStorage.getItem('taskPrioritiesHeight') || 200, maxTableHeight),
  });


  onMounted(() => {
      Promise.all([getTaskTypes(), getTaskStatuses(), getTaskPriorities()])
          .then(() => {
          // Dopo che tutte le chiamate alle API sono completate, calcola le altezze delle tabelle
          calculateTableHeights();
      })
      .finally(() => {
          isLoadingTypes.value = false;
          isLoadingStatuses.value = false;
          isLoadingPriorities.value = false;
      });
  });

/**
 * Functions
 */
 const getTaskTypes = () => {
      return axios.get('/api/tasktypes').then((response) => {
          taskTypes.value = response.data;
      });
  };

  const getTaskStatuses = () => {
      return axios.get('/api/taskstatuses').then((response) => {
          taskStatuses.value = response.data;
      });
  };

  const getTaskPriorities = () => {
      return axios.get('/api/taskpriorities').then((response) => {
          taskPriorities.value = response.data;
      });
  };

const calculateTableHeights = () => {
      console.log(tableHeights.value);
      if (taskTypesTable.value) {
          const height = taskTypesTable.value.clientHeight;
          tableHeights.value.taskTypes = Math.min(height, maxTableHeight);
          localStorage.setItem('taskTypesHeight', tableHeights.value.taskTypes);
      }
      if (taskStatusesTable.value) {
          const height = taskStatusesTable.value.clientHeight;
          tableHeights.value.taskStatuses = Math.min(height, maxTableHeight);
          localStorage.setItem('taskStatusesHeight', tableHeights.value.taskStatuses);
      }
      if (taskPrioritiesTable.value) {
          const height = taskPrioritiesTable.value.clientHeight;
          tableHeights.value.taskPriorities = Math.min(height, maxTableHeight);
          localStorage.setItem('taskPrioritiesHeight', tableHeights.value.taskPriorities);
      }
  };
</script>