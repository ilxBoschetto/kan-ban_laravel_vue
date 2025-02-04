<template>
  <div class="kanban-column flex-1 mx-3"
    :style="{ background: background, color: 'white', maxWidth: '20%', minHeight: '100px', height: 'min-content' }">
    <div class="kanban-column-header row">
      <div class="col">
        <h2 class="font-bold">{{ name }}</h2>
      </div>
      <div class="column-option-container col-sm-3 d-flex justify-content-end align-items-center gap-2">
        <button @click="editColumn" type="button" class="text-white rounded">
          <font-awesome-icon :icon="['fas', 'pen']" :style="{ color: 'white' }" />
        </button>
        <button @click="deleteColumn(id)" type="button">
          <font-awesome-icon
          :icon="['fas', 'trash']"
          :style="{ color: 'red' }"
          >
          </font-awesome-icon>
        </button>
      </div>
    </div>
    <hr style="border-bottom:rgb(150, 150, 150) solid 0.1rem; margin: 0 2rem 0 2rem">
    <div
      class="cards-container"
      v-bind:style="{ minHeight: tasks.length > 0 ? 'auto' : '0' }"
    >
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
            :task_status_id="element.task_status_id" :description="element.description">
          </KanBanCard>
        </template>
      </Draggable>
    </div>
  </div>
  

</template>

<script setup>
// Import
import KanBanCard from './KanBanCard.vue';
import { inject, watch, ref, defineEmits, nextTick } from 'vue';
import Draggable from 'vuedraggable';
import { Form, Field, ErrorMessage  } from 'vee-validate';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import * as yup from 'yup';
import axios from 'axios';

// Define Variables
const emit = defineEmits(['columnAdded', 'columnDeleted', 'editColumn']);
const form = ref(null);
const formValues = ref({});

const schema = yup.object({
  name: yup.string().required(),
  background_color: yup.string(),
});
const formData = ref({
  name: '',
  background_color: '#ffffff',
});

// Define Props
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

// Listen Events
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

  // create new position
  if(prevTask && nextTask){
    position = (prevTask.pivot.index + nextTask.pivot.index) / 2;
  } else if (prevTask){
    position = prevTask.pivot.index + (prevTask.pivot.index / 2);
  } else if (nextTask){
    position = nextTask.pivot.index / 2;
  }

  // axios call
  axios.put('/api/updateTaskIndex', {
      params:{
        index: position,
        taskId: task.id,
        columnId: props.id,
      }
    })
    .then((response) => {

    });
};

// Functions
function editColumn() {
  emit('editColumn', { id: props.id, name: props.name, background: props.background });
}

const deleteColumn = () => {
  axios.delete('/api/column/' + props.id)
    .then((response) => {
      emit('columnDeleted', props.id);
      form.value.resetForm();
    });
};

</script>