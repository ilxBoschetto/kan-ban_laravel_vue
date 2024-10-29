<template>
  <div class="kanban-column flex-1 mx-3"
    :style="{ background: background, color: 'white', maxWidth: '20%', minHeight: '100px', height: 'auto' }">
    <div class="kanban-column-header">
      <h2 class="font-bold">{{ name }}</h2>
    </div>
    <div class="px-4 flex-1 overflow-y-auto">
      <Draggable
      :list="tasks"
      group="tasks"
      item-key="id"
      tag="div"
      drag-class="drag"
      ghost-class="ghost"
      @change="onChange"
      >
        <template #item="{ element }">
          <KanBanCard :id="element.id" :name="element.name" :task_type_id="element.task_type_id"
            :task_status_id="element.task_status_id">
          </KanBanCard>
        </template>
      </Draggable>
    </div>
  </div>
</template>
<script setup>
import KanBanCard from './KanBanCard.vue';
import { defineProps, inject, watch } from 'vue';
import Draggable from 'vuedraggable';

const props = defineProps({
  id: Number,
  name: {
    type: String,
    required: true
  },
  background: {
    type: String,
    required: true
  },
  tasks: Array,
});
const tasks = props.tasks;
watch(() => props.tasks, (newTask) => tasks.value = newTask);

const onChange = (e) => {
  let item = e.added || e.moved;
  if(!item)
    return;

  let taskId = item.element.id;
  
  let index = tasks.findIndex(task => task.id == taskId);
  let prevTask = index > 0 ? tasks[index - 1] : null;
  let nextTask = index < tasks.length - 1 ? tasks[index + 1] : null;
  let task = tasks[index];
  let position = task.pivot.index;

  if(prevTask && nextTask){
    position = (prevTask.pivot.index + nextTask.pivot.index) / 2;
  } else if (prevTask){
    position = prevTask.pivot.index + (prevTask.pivot.index / 2);
  } else if (nextTask){
    position = nextTask.pivot.index / 2;
  }

  axios.put('/api/updateTaskIndex', {
      params:{
        index: position,
        taskId: task.id,
        columnId: props.id,
      }
    })
    .then((response) => {

    });
}

</script>