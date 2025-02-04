<template>
    <div>
      
      <div class="flex justify-start p-3" :style="{ background: board.background, height: '100%' }">
        <KanbanColumn
          v-for="column in columns"
          :key="column.id"
          :id="column.id"
          :name="column.name"
          :background="column.background"
          :tasks="column.tasks"
          @editColumn="openEditModal"
          @columnAdded="addColumn"
          @columnDeleted="deleteColumn"
          >
          </KanbanColumn>
          <div class="kanban-add-column flex-1 mx-3" @click="openModal"
            :style="{ background: board.background, maxWidth: '20%', height: '100px' }">
            <font-awesome-icon
              :icon="['fas', 'plus']">
              </font-awesome-icon>
          </div>
        </div>
        <!-- Modale per Editare Colonna -->
        <EditColumnModal
          v-if="isModalOpen"
          :column="currentColumn"
          @close="closeModal"
          @save="saveChanges"
        />
    </div>
</template>

<script setup>
import { ref, onMounted, provide, nextTick } from 'vue';
import KanbanColumn from './KanbanColumn.vue';
import EditColumnModal from './EditColumnModal.vue';
import axios from 'axios';

const boardId = 1;
const columns = ref([]);
const tasks = ref([]);

const board = ref({
  name: '',
  background: '#ffffff'
});

const isModalOpen = ref(false);
const currentColumn = ref({ id: null, name: '', background: '' });

function openEditModal(columnData) {
  currentColumn.value = { ...columnData }; // Clona i dati della colonna
  isModalOpen.value = true;
}

function closeModal() {
  isModalOpen.value = false;
}

function saveChanges(updatedColumn) {
  const index = columns.value.findIndex(col => col.id === updatedColumn.id);
  if (index !== -1) {
    columns.value[index] = { ...updatedColumn }; // Aggiorna la colonna
  }
  closeModal();
}

const initKanBan = () => {
  axios.get('/api/kanban', {
    params: {
      boardId: boardId
    }
  })
    .then((response) => {
      board.value = response.data;
      columns.value = response.data.columns;
    });
};

const taskTypes = ref([]);
const addColumn = (newColumn) => {
  columns.value.push(newColumn);
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