<template>
    <div class="flex justify-around p-5 bg-gray-100 min-h-screen">
      <KanbanColumn
        v-for="column in columns"
        :key="column"
        :status="column"
        :cards="cards.filter(card => card.status === column)"
        @moveCard="moveCard"
      ></KanbanColumn>
    </div>
  </template>

<script setup>
import { ref, onMounted } from 'vue';
import KanbanColumn from './KanbanColumn.vue';
import axios from 'axios';

const cards = ref([{ id: 1, title:'task1', status: 'Done'}]);

const getTasks = () => {
  axios.get('/tasks')
  .then((response) => {
    cards.value = response.data;
  })
}

const columns = ref(['New', 'To Do', 'In Progress', 'Done']); // axios call

const getColumns = () => {
  axios.get('/columns')
  .then((response) => {
    columns.value = response.data;
  })
}


const board = [];// axios call
const moveCard = (cardId, newStatus) => {
  const card = cards.value.find(card => card.id === cardId);
  if (card) {
    card.status = newStatus;
  }
};

onMounted(() => {
  getTasks();
  getColumns();
})

</script>