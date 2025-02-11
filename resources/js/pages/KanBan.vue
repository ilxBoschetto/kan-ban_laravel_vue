<template>
  
  <div>
    <div id="spinner-wheel" class="loader-container">
      <font-awesome-icon :icon="['fas', 'spinner']" spin class="loader-icon"></font-awesome-icon>
    </div>
    <div class="flex justify-start" :style="{ height: '100%' }">
      <KanbanColumn v-for="column in columns" :key="column.id" :id="column.id" :name="column.name"
        :background="column.background" :tasks="column.tasks" @addTask="openAddTaskModal"
        @editColumn="openEditColumnModal" @columnAdded="addColumn" @columnDeleted="deleteColumn">
      </KanbanColumn>
      <div class="kanban-add-column flex-1 mx-2" @click="openEditColumnModal()"
        :style="{ background: 'transparent', maxWidth: '20%', height: '100px' }">
        <font-awesome-icon :icon="['fas', 'plus']">
        </font-awesome-icon>
      </div>
    </div>
    <!-- Modale per Editare Colonna -->
    <EditColumnModal v-if="isModalOpen" :column="currentColumn" @close="closeModal" @save="saveChanges" />

    <!-- Modale per Editare Task -->
    <EditTaskModal v-if="isTaskModalOpen" :column="currentColumn" :task="currentTask" :taskTypes="taskTypes"
      :taskStatuses="taskStatuses" @closeTaskModal="closeTaskModal" @saveTask="saveTask" />
  </div>
</template>

<script setup>
/**
 * Imports
 */
import { ref, onMounted, provide } from 'vue';
import KanbanColumn from '../components/KanbanColumn.vue';
import EditColumnModal from '../components/EditColumnModal.vue';
import axios from 'axios';
import EditTaskModal from '../components/EditTaskModal.vue';

/**
 * Variables
 */
const boardId = 1;
const columns = ref([]);
const tasks = ref([]);
const isModalOpen = ref(false);
const isTaskModalOpen = ref(false);
const taskTypes = ref([]);
const taskStatuses = ref([]);
const currentColumn = ref({
  id: null,
  name: '',
  background: ''
});
const currentTask = ref({
  id: null,
  name: ''
});
const board = ref({
  name: '',
  background: '#ffffff'
});

onMounted(() => {
  initKanBan();
  getTaskTypes();
  getTaskStatuses();
})

/**
 * Functions
 */
function openEditColumnModal(column = null) {
  currentColumn.value = column
    ? { ...column }  // Clona i dati se stiamo modificando
    : { id: -1, name: '', background: '#ffffff', tasks: [] }; // Nuova colonna

  isModalOpen.value = true;
}

function openAddTaskModal(column, task = null) {
  currentTask.value = task
    ? { ...task }  // Clona i dati se stiamo modificando
    : { id: -1, name: '', column_id: column.id }; // Nuova task
  isTaskModalOpen.value = true;
}

function closeTaskModal() {
  isTaskModalOpen.value = false;
}

function closeModal() {
  isModalOpen.value = false;
}

function saveChanges(updatedColumn) {
  const index = columns.value.findIndex(col => col.id === updatedColumn.id);
  if (index !== -1) {
    updateColumn(updatedColumn);
  } else {
    addColumn(updatedColumn);
  }
  closeModal();
}

function saveTask(task) {
  const index = tasks.value.findIndex(task => task.id === task.id);
  if (index !== -1) {
    updateTask(task);
  } else {
    addTask(task);
  }
  closeTaskModal();
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

const initKanBan = () => {
  loadingCallback(true);
  axios.get('/api/kanban', {
    params: {
      boardId: boardId
    }
  })
    .then((response) => {
      board.value = response.data;
      columns.value = response.data.columns;
      loadingCallback(false);
    });
};

const addColumn = (newColumn) => {
  axios.post('/api/column', {
    name: newColumn.name,
    background_color: newColumn.background,
  })
    .then((response) => {
      columns.value.push(response.data);
    });
};

const updateColumn = (column) => {
  const index = columns.value.findIndex(col => col.id === column.id);
  axios.put('/api/column/' + column.id, {
    name: column.name,
    background_color: column.background,
  })
    .then((response) => {
      columns.value[index] = { ...column }; // Aggiorna la colonna
    });
};

const deleteColumn = (columnId) => {
  columns.value = columns.value.filter(column => column.id !== columnId);
  initKanBan();
};

const addTask = (task) => {
  axios.post('/api/task', {
    name: task.task.name,
    description: task.task.description ?? '',
    column_id: task.column_id,
    task_type_id: task.task_type_id,
    task_status_id: task.task_status_id
  })
    .then((response) => {
      const columnId = response.data.pivot.board_column_id;
      const column = columns.value.find(col => col.id === columnId);
      if (column) {
        const newTask = { ...response.data };
        
        column.tasks.push(newTask);
      }

    });
};

const updateTask = (task) => {
  // TODO
  /*
  axios.put('/api/task/' + task.id, {
    name: task.name,
    description: task.description,
    task_type_id: task.task_type_id,
    task_status_id: task.task_status_id
  })
    .then((response) => {
      tasks.value[index] = { ...task }; // Aggiorna la task
    });
    */
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

// provide taskType to children
provide('taskTypes', taskTypes);
provide('taskStatuses', taskStatuses);

</script>