<template>
    <div
      class="kanban-column bg-white flex-1 mx-3"
      @dragover.prevent
      @drop="drop($event)"
    >
      <div class="kanban-column-header">
        <h2 class="font-bold">{{ status }}</h2>
        </div>
      <div class="p-4">
        <KanbanCard
        v-for="card in cards"
        :key="card.id"
        :card="card"
      ></KanbanCard>
        </div>
      
    </div>
  </template>
  
  <script setup>
  import { defineProps, defineEmits } from 'vue';
  import KanbanCard from './KanbanCard.vue';
  const props = defineProps({
    status: String,
    cards: Array,
  });
  const emit = defineEmits(['moveCard']);
  const drop = event => {
    const cardId = event.dataTransfer.getData('text/plain');
    emit('moveCard', parseInt(cardId, 10), props.status);
  };
  </script>