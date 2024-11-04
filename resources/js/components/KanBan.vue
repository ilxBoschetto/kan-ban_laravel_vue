<template>
  <div>
    <h1>{{ board.name }}</h1>
    <div class="flex justify-start p-3 min-h-screen" :style="{ background: board.background }">
      <KanbanColumn
      v-for="column in columns"
      :key="column.id"
      :id="column.id"
      :name="column.name"
      :background="column.background"
      :tasks="column.tasks"
      @columnAdded="addColumn"
      @columnDeleted="deleteColumn"
      >
      </KanbanColumn>
    </div>
  </div>

  
</template>

<script setup>
import { ref, onMounted, provide } from 'vue';
import KanbanColumn from './KanbanColumn.vue';
import axios from 'axios';

const boardId = 1;
const columns = ref([]);
const tasks = ref([]);

const board = ref({
  name: 'default',
  background: '#ffffff'
});

const initKanBan = () => {
  axios.get('/api/kanban', {
    params: {
      boardId: boardId
    }
  })
    .then((response) => {
      board.value = response.data;
      columns.value = response.data.columns;
      console.log(columns.value);
    });
};

const taskTypes = ref([]);
const addColumn = (newColumn) => {
  columns.value.push(newColumn);
  console.log(newColumn);
  initKanBan();
};
const deleteColumn = (columnId) => {
    columns.value = columns.value.filter(column => column.id !== columnId);
    initKanBan();
  };

const getTaskTypes = () => {
  axios.get('/api/tasktypes')
    .then((response) => {
      taskTypes.value = response.data;
    });
};

const taskStatuses = ref([]);

const getTaskStatuses = () => {
  axios.get('/api/taskstatuses')
    .then((response) => {
      taskStatuses.value = response.data;
    });
};

// provide taskType to children
provide('taskTypes', taskTypes);
provide('taskStatuses', taskStatuses);

onMounted(() => {
  initKanBan();
  getTaskTypes();
  getTaskStatuses();
})

</script>