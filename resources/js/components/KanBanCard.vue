<template>
    <div
      class="kanban-card bg-gray-100 rounded p-3 mb-2 cursor-pointer"
      draggable="true"
      @dragstart="dragStart($event, card)"
    >
      {{ card.title }}
    </div>
  </template>
  
  <script setup>
  import { defineProps } from 'vue';
  const props = defineProps({
    card: Object,
  });
  const dragStart = (event, card) => {
    event.dataTransfer.setData('text/plain', card.id);
  };
  </script>